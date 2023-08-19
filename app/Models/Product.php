<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model {
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "category_id",
        "name",
        "price",
        "offer_price",
        "description",
        "stock",
        "duration",
        "duration_type",
        "start_price",
        "end_price",
        "total_purchased",
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    public function getRatingAttribute() {
        return $this->reviews()->avg("rating");
    }

    public function category() {
        return $this->belongsTo(Category::class, "category_id")->withTrashed();
    }

    public function images() {
        return $this->hasMany(ProductImage::class, "product_id");
    }

    public function reviews() {
        return $this->hasMany(ProductReview::class, "product_id");
    }
}
