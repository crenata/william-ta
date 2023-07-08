<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionAttachment extends Model {
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "transaction_id",
        "attachment",
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    public function getAttachmentAttribute() {
        return env("APP_URL") . "/storage/transactions/attachments/" . $this->attributes["attachment"];
    }

    public function transaction() {
        return $this->belongsTo(Transaction::class, "transaction_id");
    }
}
