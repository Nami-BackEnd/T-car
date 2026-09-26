<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('car_branches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained('cars')->cascadeOnDelete();
            $table->foreignId('branch_id')->constrained('branches')->cascadeOnDelete();
            $table->unsignedInteger('stock')->default(0);
            $table->unique(['car_id', 'branch_id'], 'car_branches_car_branch_unique');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('car_branches');
    }
};
