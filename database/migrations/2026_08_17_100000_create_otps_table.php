<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('otps', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['user', 'driver', 'company']);
            $table->string('otp');
            $table->timestamp('expire_at');
            $table->string('phone');
            $table->string('phone_code');
            $table->enum('otp_type', ['login', 'change_phone'])->default('login');
            $table->boolean('is_used')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('otps');
    }
};
