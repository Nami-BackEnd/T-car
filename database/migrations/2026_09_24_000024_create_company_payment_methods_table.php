<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('company_payment_methods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_profile_id')->constrained('companies')->cascadeOnDelete();
            $table->foreignId('payment_method_id')->constrained('payment_methods')->cascadeOnDelete();
            $table->unique(['company_profile_id', 'payment_method_id'], 'company_payment_methods_profile_method_unique');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_payment_methods');
    }
};