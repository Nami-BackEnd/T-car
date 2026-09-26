<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('car_pricing', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->unique()->constrained('cars')->cascadeOnDelete();
            $table->decimal('day_price', 10, 2)->default(0);
            $table->decimal('day_lowest_price', 10, 2)->default(0);
            $table->decimal('week_price', 10, 2)->default(0);
            $table->decimal('week_lowest_price', 10, 2)->default(0);
            $table->decimal('month_price', 10, 2)->default(0);
            $table->decimal('month_lowest_price', 10, 2)->default(0);
            $table->unsignedInteger('free_km')->default(0);
            $table->decimal('free_km_price', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('car_pricing');
    }
};
