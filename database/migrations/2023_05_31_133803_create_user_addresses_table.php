<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create("user_addresses", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->string("name");
            $table->longText("address");
            $table->timestamps();

            $table->foreign("user_id")->references("id")->on((new User())->getTable())->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists("user_addresses");
    }
};
