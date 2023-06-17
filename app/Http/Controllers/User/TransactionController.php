<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
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
        $transactions = Transaction::with("latestHistory", "histories", "userAddress")
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
            ->where("user_id", auth()->id())
            ->orderByDesc("transactions.id")
            ->paginate();

        return view("user.transaction.view")->withTransactions($transactions);
    }
}
