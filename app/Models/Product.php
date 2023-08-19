<?php

namespace App\Models;

use App\Constants\MidtransStatusConstant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

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
        "gold_price",
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

    public function getIsGoldAttribute() {
        if (!auth()->check()) return false;

        $detailIds = DB::table("transaction_histories as detail_mx")
            ->selectRaw("max(detail_mx.id) as detail_id, detail_mx.transaction_id")
            ->groupBy("detail_mx.transaction_id")
            ->toSql();
        $detailData = DB::table("transaction_histories as detail_data")
            ->selectRaw("detail_data.id, detail_data.status")
            ->toSql();
        $summary = $this->hasMany(Transaction::class, "product_id")
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
            ->where("user_id", auth()->id())
            ->whereIn("detail.status", [
                MidtransStatusConstant::SETTLEMENT,
                MidtransStatusConstant::PROCESSED,
                MidtransStatusConstant::DELIVERY,
                MidtransStatusConstant::ARRIVED
            ])->sum("gross_amount");

        return $summary >= env("GOLD_MEMBERSHIP_REQUIREMENT");
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
