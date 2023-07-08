<?php

namespace App\Http\Controllers\Admin;

use App\Constants\MidtransStatusConstant;
use App\Http\Controllers\Controller;
use App\Models\CustomTransaction;
use App\Models\CustomTransactionHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $transactions = CustomTransaction::with("latestHistory", "histories", "images", "attachments", "user", "userAddress")
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
            ->orderByDesc("custom_transactions.id")
            ->paginate();

        $statuses = [];
        foreach (
            [
                MidtransStatusConstant::PROCESSED,
                MidtransStatusConstant::DELIVERY,
                MidtransStatusConstant::ARRIVED,
                MidtransStatusConstant::REQUEST_RETURN,
                MidtransStatusConstant::RETURN_REJECTED,
                MidtransStatusConstant::PROCESS_RETURN,
                MidtransStatusConstant::RETURNED
            ] as $status
        ) {
            $statuses[ucwords(
                str_replace(
                    "_",
                    " ",
                    strtolower(
                        MidtransStatusConstant::getNameByValue($status)
                    )
                )
            )] = $status;
        }

        return view("admin.custom.view")->withTransactions($transactions)->withStatuses($statuses);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request) {
        $this->validate($request, [
            "custom_transaction_id" => "required|numeric|exists:custom_transactions,id"
        ]);

        if (in_array($request->status, MidtransStatusConstant::values())) {
            $transaction = CustomTransaction::findOrFail($request->custom_transaction_id);
            CustomTransactionHistory::create([
                "custom_transaction_id" => $transaction->id,
                "status" => $request->status
            ]);
        }
        return back()->withStatus("Successfully edited.");
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param string $id
     */
    public function update(Request $request, string $id) {
        $this->validate($request, [
            "price" => "required|numeric|min:1"
        ]);

        return DB::transaction(function () use ($request, $id) {
            $transaction = CustomTransaction::findOrFail($id);
            $transaction->gross_amount += $request->price;
            $transaction->save();
            CustomTransactionHistory::create([
                "custom_transaction_id" => $transaction->id,
                "status" => MidtransStatusConstant::PRICE_SUBMITTED
            ]);
            return back()->withStatus("Successfully added.");
        });
    }
}
