<?php

namespace App\Http\Controllers\Admin;

use App\Constants\MidtransStatusConstant;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $detailIds = DB::table("transaction_histories as detail_mx")
            ->selectRaw("max(detail_mx.id) as detail_id, detail_mx.transaction_id")
            ->groupBy("detail_mx.transaction_id")
            ->toSql();
        $detailData = DB::table("transaction_histories as detail_data")
            ->selectRaw("detail_data.id, detail_data.status")
            ->toSql();
        $selects = [
            env("DB_CONNECTION") === "mysql" ?
                "date_format(created_at, '%M') as label" :
                "to_char(created_at, 'Mon') as label",
            "extract(month from created_at) as month",
            "extract(year from created_at) as year",
            "sum(gross_amount) as total"
        ];
        $conditions = [
            "extract(year from created_at) = $year"
        ];
        $orderBy = "month";
        if ($request->filter === "weekly") {
            $selects = [
                env("DB_CONNECTION") === "mysql" ?
                    "week(created_at) as label" :
                    "to_char(created_at, 'W') as label",
                env("DB_CONNECTION") === "mysql" ?
                    "week(created_at) as week" :
                    "to_char(created_at, 'W') as week",
                "extract(month from created_at) as month",
                "sum(gross_amount) as total"
            ];
            $conditions = [
                "extract(month from created_at) = $month"
            ];
            $orderBy = "week";
        }
        if ($request->filter === "daily") {
            $selects = [
                env("DB_CONNECTION") === "mysql" ?
                    "date_format(created_at, '%d') as label" :
                    "to_char(created_at, 'DD') as label",
                "extract(day from created_at) as day",
                "extract(month from created_at) as month",
                "sum(gross_amount) as total"
            ];
            $conditions = [
                "extract(month from created_at) = $month"
            ];
            $orderBy = "day";
        }
        $transactions = Transaction::selectRaw(implode(",", $selects))
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
            ->whereRaw(implode(" and ", array_merge([
                "detail.status = " . MidtransStatusConstant::SETTLEMENT
            ], $conditions)))
            ->groupByRaw("1,2,3")
            ->orderBy($orderBy)
            ->get();

        $labels = [];
        $data = [];
        foreach ($transactions as $transaction) {
            array_push($labels, $transaction->label);
            array_push($data, (int) $transaction->total);
        }

        $filters = [
            [
                "value" => "monthly",
                "label" => "Monthly"
            ],
            [
                "value" => "weekly",
                "label" => "Weekly"
            ],
            [
                "value" => "daily",
                "label" => "Daily"
            ]
        ];

        return view("admin.home")
            ->withLabels($labels)
            ->withData($data)
            ->withFilters($filters)
            ->withCurrentFilter($request->filter);
    }
}
