<?php

namespace App\Http\Controllers\User;

use App\Constants\MidtransStatusConstant;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionHistory;
use App\Models\TransactionImage;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;

class ProductController extends Controller {
    /**
     * Display a listing of the resource.
     * @param string $id
     * @return mixed
     */
    public function index(string $id = null) {
        $categories = Category::all();
        $products = Product::with("category")->whereNull("offer_price");
        if (!empty($id)) $products = $products->where("category_id", $id);
        $products = $products->paginate();
        return view("user.product.view")->withCategories($categories)->withProducts($products)->withCategoryId((int) $id);
    }

    /**
     * Display a listing of the resource.
     * @param string $id
     * @return mixed
     */
    public function offer(string $id = null) {
        $categories = Category::all();
        $products = Product::with("category")->whereNotNull("offer_price");
        if (!empty($id)) $products = $products->where("category_id", $id);
        $products = $products->paginate();
        return view("user.product.view")->withCategories($categories)->withProducts($products)->withCategoryId((int) $id);
    }

    /**
     * Display the specified resource.
     * @param string $id
     */
    public function show(string $id) {
        $userAddresses = UserAddress::where("user_id", auth()->id())->get();
        $product = Product::with("category", "images")->findOrFail($id);
        return view("user.product.show")->withProduct($product)->withUserAddresses($userAddresses);
    }

    /**
     * Buy.
     * @param Request $request
     * @param string $id
     */
    public function buy(Request $request) {
        $this->validate($request, [
            "user_address_id" => "required|numeric|exists:user_addresses,id",
            "product_id" => "required|numeric|exists:products,id",
            "quantity" => "required|numeric|min:1"
        ]);

        return DB::transaction(function () use ($request) {
            $userAddress = UserAddress::findOrFail($request->user_address_id);
            $product = Product::with("images")->findOrFail($request->product_id);
            $grossAmount = empty($product->offer_price) ? $product->price : $product->offer_price;

            $now = Carbon::now();
            $invoiceNumber = $now->format("Y-") .
                Str::random(4) .
                $now->format("-m-") .
                Str::random(4) .
                $now->format("-d-") .
                Str::random(12);

            Config::$serverKey = env("MIDTRANS_SERVER_KEY");
            Config::$isProduction = env("MIDTRANS_PRODUCTION");
            Config::$isSanitized = true;
            Config::$is3ds = true;
            Config::$overrideNotifUrl = env("MIDTRANS_OVERRIDE_NOTIFICATION_URL");

            $snapUrl = Snap::getSnapUrl([
                "transaction_details" => [
                    "order_id" => $invoiceNumber,
                    "gross_amount" => $grossAmount
                ]
            ]);

            $transaction = Transaction::create([
                "user_id" => auth()->id(),
                "user_address_id" => $userAddress->id,
                "product_id" => $product->id,
                "name" => $product->name,
                "description" => $product->description,
                "quantity" => $request->quantity,
                "invoice_number" => $invoiceNumber,
                "gross_amount" => $grossAmount,
                "snap_url" => $snapUrl
            ]);
            TransactionHistory::create([
                "transaction_id" => $transaction->id,
                "status" => MidtransStatusConstant::PENDING
            ]);
            foreach ($product->images as $image) {
                TransactionImage::create([
                    "transaction_id" => $transaction->id,
                    "image" => $image->image
                ]);
            }

            return redirect($snapUrl);
        });
    }

    public function update(Request $request) {
        $this->validate($request, [
            "order_id" => "required|string|exists:transactions,invoice_number",
            "transaction_status" => "required|string"
        ]);

        $transaction = Transaction::where("invoice_number", $request->order_id)->firstOrFail();
        TransactionHistory::create([
            "transaction_id" => $transaction->id,
            "status" => MidtransStatusConstant::getValueByName(strtoupper($request->transaction_status))
        ]);

        return response()->json([
            "message" => "OK"
        ]);
    }
}
