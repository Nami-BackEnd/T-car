<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar');
            $table->string('title_en');
            $table->timestamps();
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->foreign('country_id')
                ->references('id')
                ->on('countries')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropForeign(['country_id']);
        });

        Schema::dropIfExists('countries');
    }
};
