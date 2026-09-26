<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('car_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained('cars')->cascadeOnDelete();
            $table->unsignedInteger('month_count');
            $table->decimal('price', 10, 2)->default(0);
            $table->decimal('lowest_price', 10, 2)->default(0);
            $table->unique(['car_id', 'month_count'], 'car_subscriptions_car_month_unique');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('car_subscriptions');
    }
};
