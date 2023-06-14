<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model {
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "answer_id",
        "name",
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    public function answer() {
        return $this->belongsTo(Answer::class, "answer_id");
    }
}
