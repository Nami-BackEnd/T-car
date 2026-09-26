<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('insurance_policy_id');
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->enum('insurance_policy_type', ['comprehensive', 'deductible'])
                ->nullable()
                ->after('max_late_hours_allowed');
            $table->decimal('insurance_policy_value', 10, 2)
                ->nullable()
                ->after('insurance_policy_type');
            $table->unsignedInteger('branch_count')
                ->default(1)
                ->after('license_category');
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropForeign(['city_id']);
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn(['insurance_policy_type', 'insurance_policy_value', 'branch_count']);
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->foreignId('insurance_policy_id')->nullable()->after('max_late_hours_allowed');
        });
    }
};
