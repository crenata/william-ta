<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model {
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
        "name",
        "description",
        "quantity",
        "invoice_number",
        "gross_amount",
        "snap_url",
        "reason",
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    public function getIsReviewedAttribute() {
        return $this->hasOne(ProductReview::class, "transaction_id")->exists();
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
        return $this->hasMany(TransactionImage::class, "transaction_id");
    }

    public function attachments() {
        return $this->hasMany(TransactionAttachment::class, "transaction_id");
    }

    public function histories() {
        return $this->hasMany(TransactionHistory::class, "transaction_id");
    }

    public function latestHistory() {
        return $this->hasOne(TransactionHistory::class, "transaction_id")->orderByDesc("id");
    }
}
