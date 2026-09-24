<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('branch_train_stations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained('branches')->cascadeOnDelete();
            $table->foreignId('train_station_id')->constrained('train_stations')->cascadeOnDelete();
            $table->unique(['branch_id', 'train_station_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('branch_train_stations');
    }
};
