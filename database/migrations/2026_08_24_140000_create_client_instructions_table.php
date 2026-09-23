<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('client_instructions', function (Blueprint $table) {
            $table->id();
            $table->text('content_ar');
            $table->text('content_en');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('client_instructions');
    }
};
