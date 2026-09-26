<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->foreignId('car_brand_id')->nullable()->constrained('brands')->nullOnDelete();
            $table->foreignId('car_type_id')->nullable()->constrained('car_types')->nullOnDelete();
            $table->foreignId('car_model_id')->nullable()->constrained('car_models')->nullOnDelete();
            $table->year('year')->nullable();
            $table->unsignedInteger('count')->default(0);
            $table->text('note_ar')->nullable();
            $table->text('note_en')->nullable();
            $table->boolean('is_subscriber')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
