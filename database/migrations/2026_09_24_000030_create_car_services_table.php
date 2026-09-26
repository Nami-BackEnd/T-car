<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('car_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained('cars')->cascadeOnDelete();
            $table->foreignId('car_additional_service_id')->constrained('car_additional_services')->cascadeOnDelete();
            $table->decimal('price', 10, 2)->default(0);
            $table->unique(['car_id', 'car_additional_service_id'], 'car_services_car_service_unique');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('car_services');
    }
};
