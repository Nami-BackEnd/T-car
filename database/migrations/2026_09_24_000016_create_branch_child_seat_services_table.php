<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('branch_child_seat_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained('branches')->cascadeOnDelete();
            $table->decimal('day_price', 10, 2)->nullable();
            $table->decimal('week_price', 10, 2)->nullable();
            $table->decimal('month_price', 10, 2)->nullable();
            $table->unique('branch_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('branch_child_seat_services');
    }
};
