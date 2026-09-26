<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('company_services', function (Blueprint $table) {
            $table->enum('pricing_type', ['payed', 'free'])->default('free')->after('company_id');
            $table->decimal('price', 10, 2)->nullable()->after('pricing_type');
        });

        Schema::table('company_services', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
        });

        Schema::table('company_services', function (Blueprint $table) {
            $table->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('company_services', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
        });

        Schema::table('company_services', function (Blueprint $table) {
            $table->foreign('company_id')
                ->references('id')
                ->on('company_users')
                ->cascadeOnDelete();
        });

        Schema::table('company_services', function (Blueprint $table) {
            $table->dropColumn(['pricing_type', 'price']);
        });
    }
};
