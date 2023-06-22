<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductReviewAttachment extends Model {
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "product_review_id",
        "attachment",
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    public function getAttachmentAttribute() {
        return env("APP_URL") . "/storage/products/reviews/" . $this->attributes["attachment"];
    }

    public function productReview() {
        return $this->belongsTo(ProductReview::class, "product_review_id");
    }
}
