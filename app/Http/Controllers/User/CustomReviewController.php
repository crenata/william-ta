<?php

namespace App\Http\Controllers\User;

use App\Helpers\StorageHelper;
use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use App\Models\ProductReviewAttachment;
use App\Models\CustomTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomReviewController extends Controller {
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request) {
        $this->validate($request, [
            "transaction_id" => "required|numeric|exists:transactions,id",
            "review" => "required|string",
            "attachments" => "required|array",
            "attachments.*" => "required|file"
        ]);

        return DB::transaction(function () use ($request) {
            $transaction = CustomTransaction::findOrFail($request->transaction_id);
            $review = ProductReview::create([
                "user_id" => auth()->id(),
                "custom_transaction_id" => $transaction->id,
                "product_id" => $transaction->product_id,
                "review" => $request->review
            ]);

            foreach ($request->file("attachments") as $key => $image) {
                ProductReviewAttachment::create([
                    "product_review_id" => $review->id,
                    "attachment" => StorageHelper::save($request, "attachments.$key", "products/reviews")
                ]);
            }

            return back()->withStatus("Successfully added.");
        });
    }
}
