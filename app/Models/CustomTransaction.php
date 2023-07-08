<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomTransaction extends Model {
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "user_id",
        "user_address_id",
        "product_id",
        "invoice_number",
        "gross_amount",
        "snap_url",
        "size",
        "color",
        "material",
        "quantity",
        "reason",
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    public function getIsReviewedAttribute() {
        return $this->hasOne(ProductReview::class, "custom_transaction_id")->exists();
    }

    public function user() {
        return $this->belongsTo(User::class, "user_id");
    }

    public function userAddress() {
        return $this->belongsTo(UserAddress::class, "user_address_id");
    }

    public function product() {
        return $this->belongsTo(Product::class, "product_id");
    }

    public function images() {
        return $this->hasMany(CustomTransactionImage::class, "custom_transaction_id");
    }

    public function attachments() {
        return $this->hasMany(CustomTransactionAttachment::class, "custom_transaction_id");
    }

    public function histories() {
        return $this->hasMany(CustomTransactionHistory::class, "custom_transaction_id");
    }

    public function latestHistory() {
        return $this->hasOne(CustomTransactionHistory::class, "custom_transaction_id")->orderByDesc("id");
    }
}
