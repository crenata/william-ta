<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('custom_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("user_address_id");
            $table->unsignedBigInteger("product_id");
            $table->string("invoice_number");
            $table->unsignedBigInteger("gross_amount")->nullable();
            $table->string("snap_url")->nullable();
            $table->string("size");
            $table->string("color");
            $table->string("material");
            $table->unsignedBigInteger("quantity");
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("user_address_id")->references("id")->on("user_addresses")->onDelete("cascade");
            $table->foreign("product_id")->references("id")->on("products")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('custom_transactions');
    }
};
