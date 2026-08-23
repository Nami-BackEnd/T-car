<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('assigned_to_all_branches')->default(false);
            $table->string('phone_code');
            $table->string('phone');
            $table->string('lang');
            $table->date('license_expiration_date');
            $table->string('identity_number');
            $table->string('email')->nullable();
            $table->string('password');
            $table->boolean('is_verified')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
