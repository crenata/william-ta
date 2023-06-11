<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImage extends Model {
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "product_id",
        "image",
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    public function getImageAttribute() {
        return env("APP_URL") . "/storage/products/" . $this->attributes["image"];
    }

    public function product() {
        return $this->belongsTo(Product::class, "product_id");
    }
}
