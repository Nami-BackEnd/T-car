<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('driver_branches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id')->constrained('drivers')->cascadeOnDelete();
            $table->foreignId('branch_id')->constrained('branches')->cascadeOnDelete();
            $table->unique(['driver_id', 'branch_id'], 'driver_branches_driver_branch_unique');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('driver_branches');
    }
};
