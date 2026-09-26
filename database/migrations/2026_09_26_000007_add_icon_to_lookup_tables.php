<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('company_additional_services', function (Blueprint $table) {
            $table->string('icon', 64)->nullable()->after('title_en');
        });

        Schema::table('payment_methods', function (Blueprint $table) {
            $table->string('icon', 64)->nullable()->after('title_en');
        });
    }

    public function down(): void
    {
        Schema::table('company_additional_services', function (Blueprint $table) {
            $table->dropColumn('icon');
        });

        Schema::table('payment_methods', function (Blueprint $table) {
            $table->dropColumn('icon');
        });
    }
};
