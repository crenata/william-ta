<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("category_id");
            $table->string("name");
            $table->unsignedBigInteger("price");
            $table->unsignedBigInteger("offer_price")->nullable();
            $table->longText("description");
            $table->unsignedBigInteger("stock")->default(0);
            $table->unsignedBigInteger("duration");
            $table->string("duration_type");
            $table->unsignedBigInteger("start_price");
            $table->unsignedBigInteger("end_price");
            $table->unsignedBigInteger("total_purchased")->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("category_id")->references("id")->on("categories")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
