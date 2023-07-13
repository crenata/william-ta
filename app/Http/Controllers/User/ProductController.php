<?php

namespace App\Http\Controllers\User;

use App\Constants\MidtransStatusConstant;
use App\Helpers\MidtransHelper;
use App\Http\Controllers\Controller;
use App\Jobs\Invoice;
use App\Models\Cart;
use App\Models\Category;
use App\Models\CustomTransaction;
use App\Models\CustomTransactionHistory;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionHistory;
use App\Models\TransactionImage;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller {
    /**
     * Display a listing of the resource.
     * @param string $id
     * @return mixed
     */
    public function index(Request $request, string $id = null) {
        $categories = Category::all();
        $category = Category::find($id);
        $products = Product::with("category")->whereNull("offer_price");
        if (!empty($id)) $products = $products->where("category_id", $id);
        if (!empty($request->search)) $products = $products->whereRaw("lower(name) like lower('%{$request->search}%')");
        $products = $products->paginate(12);
        return view("user.product.view")->withCategories($categories)->withCategory($category)->withProducts($products)->withCategoryId((int) $id);
    }

    /**
     * Display a listing of the resource.
     * @param string $id
     * @return mixed
     */
    public function offer(string $id = null) {
        $categories = Category::all();
        $category = Category::find($id);
        $products = Product::with("category")->whereNotNull("offer_price");
        if (!empty($id)) $products = $products->where("category_id", $id);
        $products = $products->paginate(12);
        return view("user.product.view")->withCategories($categories)->withCategory($category)->withProducts($products)->withCategoryId((int) $id);
    }

    /**
     * Display the specified resource.
     * @param string $id
     */
    public function show(string $id) {
        $userAddresses = UserAddress::with("area.city.province")->where("user_id", auth()->id())->get();
        $product = Product::with("category", "images", "reviews.user", "reviews.attachments")->findOrFail($id);
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
            "quantity" => "required|numeric|min:1",
            "is_cart" => "nullable|boolean"
        ]);

        return DB::transaction(function () use ($request) {
            $userAddress = UserAddress::with("area")->findOrFail($request->user_address_id);
            $product = Product::with("images")->findOrFail($request->product_id);
            if (($product->stock - $request->quantity) >= 0) {
                $grossAmount = empty($product->offer_price) ? $product->price : $product->offer_price;
                $grossAmount += $userAddress->area->fee;

                $midtrans = MidtransHelper::getSnapUrl($grossAmount);

                $transaction = Transaction::create([
                    "user_id" => auth()->id(),
                    "user_address_id" => $userAddress->id,
                    "product_id" => $product->id,
                    "name" => $product->name,
                    "description" => $product->description,
                    "quantity" => $request->quantity,
                    "invoice_number" => $midtrans->invoice_number,
                    "gross_amount" => $grossAmount,
                    "snap_url" => $midtrans->snap_url
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

                if ($request->boolean("is_cart")) {
                    Cart::where("user_id", auth()->id())->where("product_id", $product->id)->delete();
                }

                return redirect($midtrans->snap_url);
            } else {
                return back()->withStatus("Not enough stocks.");
            }
        });
    }

    public function update(Request $request) {
        $this->validate($request, [
            "order_id" => "required|string",
            "transaction_status" => "required|string"
        ]);

        return DB::transaction(function () use ($request) {
            $status = MidtransStatusConstant::getValueByName(strtoupper($request->transaction_status));
            $transaction = Transaction::with("user")->where("invoice_number", $request->order_id)->first();

            if (empty($transaction->id)) {
                $transaction = CustomTransaction::with("user")->where("invoice_number", $request->order_id)->first();
                if (!empty($transaction->id)) {
                    CustomTransactionHistory::create([
                        "custom_transaction_id" => $transaction->id,
                        "status" => $status
                    ]);
                }
            } else {
                TransactionHistory::create([
                    "transaction_id" => $transaction->id,
                    "status" => $status
                ]);
            }

            if ($status === MidtransStatusConstant::SETTLEMENT) {
                $product = Product::findOrFail($transaction->product_id);
                $product->stock--;
                $product->save();

                dispatch(new Invoice($transaction));
            }

            return response()->json([
                "message" => "OK"
            ]);
        });
    }
}
