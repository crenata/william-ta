<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomTransactionAttachment extends Model {
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "custom_transaction_id",
        "attachment",
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    public function getAttachmentAttribute() {
        return env("APP_URL") . "/storage/transactions/customs/attachments/" . $this->attributes["attachment"];
    }

    public function transaction() {
        return $this->belongsTo(Transaction::class, "custom_transaction_id");
    }
}
