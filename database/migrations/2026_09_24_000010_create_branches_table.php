<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('company_users')->cascadeOnDelete();
            $table->string('branch_type')->nullable();
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('person_name')->nullable();
            $table->string('person_email')->nullable();
            $table->string('phone_code')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('general_phone_code')->nullable();
            $table->string('general_phone_number')->nullable();
            $table->text('address')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->boolean('is_airport_branch')->default(false);
            $table->boolean('is_train_station_branch')->default(false);
            $table->text('notes_ar')->nullable();
            $table->text('notes_en')->nullable();
            $table->enum('status', ['pending', 'approved', 'reject'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
