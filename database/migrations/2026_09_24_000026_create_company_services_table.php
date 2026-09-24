<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('company_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('company_users')->cascadeOnDelete();
            $table->foreignId('company_additional_services_id')->constrained('company_additional_services')->cascadeOnDelete();
            $table->unique(['company_id', 'company_additional_services_id'], 'company_services_company_service_unique');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_services');
    }
};