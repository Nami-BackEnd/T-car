<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('drivers', function (Blueprint $table) {
            // Matches `branches.company_id`, which is scoped to the logged-in
            // company manager rather than the companies table itself.
            $table->foreignId('company_id')->after('id')->constrained('company_users')->cascadeOnDelete();
            $table->boolean('is_active')->default(true)->after('is_verified');
        });
    }

    public function down(): void
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropColumn(['company_id', 'is_active']);
        });
    }
};
