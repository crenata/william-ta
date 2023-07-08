<?php

namespace App\Http\Controllers\Admin;

use App\Constants\MidtransStatusConstant;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $detailIds = DB::table("transaction_histories as detail_mx")
            ->selectRaw("max(detail_mx.id) as detail_id, detail_mx.transaction_id")
            ->groupBy("detail_mx.transaction_id")
            ->toSql();
        $detailData = DB::table("transaction_histories as detail_data")
            ->selectRaw("detail_data.id, detail_data.status")
            ->toSql();
        $transactions = Transaction::with("latestHistory", "histories", "images", "attachments", "user", "userAddress")
            ->select("transactions.*")
            ->leftJoinSub(
                $detailIds,
                "detail_max",
                "transactions.id",
                "=",
                "detail_max.transaction_id"
            )
            ->leftJoinSub(
                $detailData,
                "detail",
                "detail.id",
                "=",
                "detail_max.detail_id"
            )
            ->orderByDesc("transactions.id")
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

        return view("admin.transaction.view")->withTransactions($transactions)->withStatuses($statuses);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request) {
        $this->validate($request, [
            "transaction_id" => "required|numeric|exists:transactions,id"
        ]);

        if (in_array($request->status, MidtransStatusConstant::values())) {
            $transaction = Transaction::findOrFail($request->transaction_id);
            TransactionHistory::create([
                "transaction_id" => $transaction->id,
                "status" => $request->status
            ]);
        }
        return back()->withStatus("Successfully edited.");
    }
}
