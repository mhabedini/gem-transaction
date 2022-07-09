<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('user_gems', function (Blueprint $table) {
            $table->foreignId('user_id')->primary();
            $table->unsignedBigInteger('gem_count')->default(0);
            $table->timestamps();

            $table->foreign('user_id')->on('users')->references('id')->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_gems');
    }
};
