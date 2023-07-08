<?php

namespace App\Http\Controllers\User;

use App\Constants\MidtransStatusConstant;
use App\Helpers\StorageHelper;
use App\Http\Controllers\Controller;
use App\Models\CustomTransaction;
use App\Models\CustomTransactionAttachment;
use App\Models\CustomTransactionHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomRefundController extends Controller {
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request) {
        $this->validate($request, [
            "tx_id" => "required|numeric|exists:transactions,id",
            "reason" => "required|string",
            "attachments" => "required|array",
            "attachments.*" => "required|file"
        ]);

        return DB::transaction(function () use ($request) {
            $transaction = CustomTransaction::findOrFail($request->tx_id);
            $transaction->reason = $request->reason;
            $transaction->save();

            CustomTransactionHistory::create([
                "custom_transaction_id" => $transaction->id,
                "status" => MidtransStatusConstant::REQUEST_RETURN
            ]);

            foreach ($request->file("attachments") as $key => $image) {
                CustomTransactionAttachment::create([
                    "custom_transaction_id" => $transaction->id,
                    "attachment" => StorageHelper::save($request, "attachments.$key", "transactions/customs/attachments")
                ]);
            }

            return back()->withStatus("Successfully added.");
        });
    }
}
