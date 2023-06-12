<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionImage extends Model {
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "transaction_id",
        "image",
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    public function transaction() {
        return $this->belongsTo(Transaction::class, "transaction_id");
    }
}
