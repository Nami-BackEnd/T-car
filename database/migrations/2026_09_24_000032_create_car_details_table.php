<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('car_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->unique()->constrained('cars')->cascadeOnDelete();
            $table->enum('power', ['diesel', 'petrol', 'hybrid', 'electric', 'gas'])->nullable();
            $table->unsignedTinyInteger('door_count')->default(4);
            $table->boolean('has_navigation')->default(false);
            $table->boolean('has_bluetooth')->default(false);
            $table->boolean('has_panorama')->default(false);
            $table->boolean('has_usp')->default(false);
            $table->boolean('has_background_camera')->default(false);
            $table->boolean('has_sensors')->default(false);
            $table->boolean('has_apple_play')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('car_details');
    }
};
