<?php

namespace App\Http\Controllers\Admin;

use App\Constants\MidtransStatusConstant;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $year = Carbon::now()->year;
        $detailIds = DB::table("transaction_histories as detail_mx")
            ->selectRaw("max(detail_mx.id) as detail_id, detail_mx.transaction_id")
            ->groupBy("detail_mx.transaction_id")
            ->toSql();
        $detailData = DB::table("transaction_histories as detail_data")
            ->selectRaw("detail_data.id, detail_data.status")
            ->toSql();
        $transactions = Transaction::selectRaw(implode(",", [
            "to_char(created_at, 'MON') as label",
            "extract(month from created_at) as month",
            "extract(year from created_at) as year",
            "sum(gross_amount) as total"
        ]))
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
            ->whereRaw(implode(" and ", [
                "extract(year from created_at) = $year",
                "detail.status = " . MidtransStatusConstant::SETTLEMENT
            ]))
            ->groupByRaw("1,2,3")
            ->orderBy("month")
            ->get();

        $labels = [];
        $data = [];
        foreach ($transactions as $transaction) {
            array_push($labels, $transaction->label);
            array_push($data, (int) $transaction->total);
        }

        return view("admin.home")->withLabels($labels)->withData($data);
    }
}
