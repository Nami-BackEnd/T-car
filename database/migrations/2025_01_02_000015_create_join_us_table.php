<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('join_us', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('phone');
            $table->string('company_name');
            $table->string('email');
            $table->string('size');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('join_us');
    }
};
