<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductReview extends Model {
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "user_id",
        "transaction_id",
        "custom_transaction_id",
        "product_id",
        "rating",
        "review",
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    public function user() {
        return $this->belongsTo(User::class, "user_id");
    }

    public function transaction() {
        return $this->belongsTo(Transaction::class, "transaction_id");
    }

    public function customTransaction() {
        return $this->belongsTo(CustomTransaction::class, "custom_transaction_id");
    }

    public function product() {
        return $this->belongsTo(Product::class, "product_id");
    }

    public function attachments() {
        return $this->hasMany(ProductReviewAttachment::class, "product_review_id");
    }
}
