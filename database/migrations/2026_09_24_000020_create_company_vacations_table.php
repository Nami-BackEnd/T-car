<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('company_vacations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('company_users')->cascadeOnDelete();
            $table->foreignId('vacation_id')->constrained('vacations')->cascadeOnDelete();
            $table->integer('day_count')->default(1);
            $table->unique(['company_id', 'vacation_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_vacations');
    }
};
