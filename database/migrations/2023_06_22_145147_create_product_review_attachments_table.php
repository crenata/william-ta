<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_review_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("product_review_id");
            $table->string("attachment");
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("product_review_id")->references("id")->on("product_reviews")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_review_attachments');
    }
};
