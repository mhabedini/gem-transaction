<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('gem_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->bigInteger('gem_added');
            $table->unsignedBigInteger('old_value');
            $table->json('tag');
            $table->timestamps();

            $table->index('user_id');

            $table->foreign('user_id')->on('users')->references('id')->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gem_transactions');
    }
};
