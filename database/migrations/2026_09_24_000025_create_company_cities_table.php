<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('company_cities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_profile_id')->constrained('companies')->cascadeOnDelete();
            $table->foreignId('city_id')->constrained('cities')->cascadeOnDelete();
            $table->unique(['company_profile_id', 'city_id'], 'company_cities_profile_city_unique');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_cities');
    }
};