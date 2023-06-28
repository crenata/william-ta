<?php

namespace App\Http\Controllers\User;

use App\Helpers\StorageHelper;
use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use App\Models\ProductReviewAttachment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $reviews = ProductReview::where("user_id", auth()->id())->paginate();
        return view("user.review.view")->withReviews($reviews);
    }

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
            $transaction = Transaction::findOrFail($request->transaction_id);
            $review = ProductReview::create([
                "user_id" => auth()->id(),
                "transaction_id" => $transaction->id,
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

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param string $id
     */
    public function update(Request $request, string $id) {
        $this->validate($request, [
            "review" => "required|string",
            "attachments" => "required|array",
            "attachments.*" => "required|file"
        ]);

        return DB::transaction(function () use ($request, $id) {
            ProductReview::where("user_id", auth()->id())->findOrFail($id)->update([
                "review" => $request->review
            ]);

            if (!empty($request->file("attachments"))) {
                ProductReviewAttachment::where("product_review_id", $id)->delete();
                foreach ($request->file("attachments") as $key => $image) {
                    ProductReviewAttachment::create([
                        "product_review_id" => $id,
                        "attachment" => StorageHelper::save($request, "attachments.$key", "products/reviews")
                    ]);
                }
            }

            return redirect()->route("review.index")->withStatus("Successfully edited.");
        });
    }

    /**
     * Remove the specified resource from storage.
     * @param string $id
     */
    public function destroy(string $id) {
        ProductReview::where("user_id", auth()->id())->findOrFail($id)->delete();

        return redirect()->route("review.index")->withStatus("Successfully deleted.");
    }
}
