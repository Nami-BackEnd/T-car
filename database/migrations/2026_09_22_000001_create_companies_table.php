<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name_ar');
            $table->string('company_name_en');
            $table->string('admin_name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->string('phone_code')->nullable();
            $table->string('license_category')->nullable();
            $table->integer('max_late_hours_allowed')->default(0);
            $table->foreignId('insurance_policy_id')->nullable();
            $table->text('address')->nullable();
            $table->foreignId('city_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('logo')->nullable();
            $table->string('commercial_record')->nullable();
            $table->string('commercial_image')->nullable();
            $table->string('tax_number')->nullable();
            $table->string('tax_image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};