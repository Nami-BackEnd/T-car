<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('airport_fast_deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained('branches')->cascadeOnDelete();
            $table->decimal('price', 10, 2)->nullable();
            $table->unique('branch_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('airport_fast_deliveries');
    }
};
