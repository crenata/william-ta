<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomTransactionHistory extends Model {
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "custom_transaction_id",
        "status",
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    public function transaction() {
        return $this->belongsTo(CustomTransaction::class, "custom_transaction_id");
    }
}
