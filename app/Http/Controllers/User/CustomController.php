<?php

namespace App\Http\Controllers\User;

use App\Constants\MidtransStatusConstant;
use App\Helpers\MidtransHelper;
use App\Http\Controllers\Controller;
use App\Models\CustomTransaction;
use App\Models\CustomTransactionHistory;
use App\Models\CustomTransactionImage;
use App\Models\Product;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CustomController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $detailIds = DB::table("custom_transaction_histories as detail_mx")
            ->selectRaw("max(detail_mx.id) as detail_id, detail_mx.custom_transaction_id")
            ->groupBy("detail_mx.custom_transaction_id")
            ->toSql();
        $detailData = DB::table("custom_transaction_histories as detail_data")
            ->selectRaw("detail_data.id, detail_data.status")
            ->toSql();
        $transactions = CustomTransaction::with("latestHistory", "histories", "userAddress")
            ->select("custom_transactions.*")
            ->leftJoinSub(
                $detailIds,
                "detail_max",
                "custom_transactions.id",
                "=",
                "detail_max.custom_transaction_id"
            )
            ->leftJoinSub(
                $detailData,
                "detail",
                "detail.id",
                "=",
                "detail_max.detail_id"
            )
            ->where("user_id", auth()->id())
            ->orderByDesc("custom_transactions.id")
            ->paginate();

        return view("user.custom.view")->withTransactions($transactions);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request) {
        $this->validate($request, [
            "user_address_id" => "required|numeric|exists:user_addresses,id",
            "product_id" => "required|numeric|exists:products,id",
            "size" => "required|string",
            "color" => "required|string",
            "material" => "required|string",
            "quantity" => "required|numeric|min:1"
        ]);

        return DB::transaction(function () use ($request) {
            $userAddress = UserAddress::with("area")->findOrFail($request->user_address_id);
            $product = Product::with("images")->findOrFail($request->product_id);

            $now = Carbon::now();
            $invoiceNumber = $now->format("Y-") .
                Str::random(4) .
                $now->format("-m-") .
                Str::random(4) .
                $now->format("-d-") .
                Str::random(12);

            $transaction = CustomTransaction::create([
                "user_id" => auth()->id(),
                "user_address_id" => $userAddress->id,
                "product_id" => $product->id,
                "invoice_number" => $invoiceNumber,
                "gross_amount" => $userAddress->area->fee,
                "size" => $request->size,
                "color" => $request->color,
                "material" => $request->material,
                "quantity" => $request->quantity
            ]);
            CustomTransactionHistory::create([
                "custom_transaction_id" => $transaction->id,
                "status" => MidtransStatusConstant::PENDING
            ]);
            foreach ($product->images as $image) {
                CustomTransactionImage::create([
                    "custom_transaction_id" => $transaction->id,
                    "image" => $image->image
                ]);
            }

            return redirect()->route("custom-user.index")->withStatus("Successfully added.");
        });
    }

    /**
     * Display the specified resource.
     * @param string $id
     */
    public function show(string $id) {
        $transaction = CustomTransaction::findOrFail($id);

        if (empty($transaction->snap_url)) {
            $midtrans = MidtransHelper::getSnapUrl($transaction->gross_amount, $transaction->invoice_number);
            $transaction->snap_url = $midtrans->snap_url;
            $transaction->save();
        }

        return redirect($transaction->snap_url);
    }
}
