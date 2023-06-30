<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model {
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "city_id",
        "name",
        "fee",
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    public function city() {
        return $this->belongsTo(City::class, "city_id");
    }
}
