<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('daily_booking_showing')->default(true);
            $table->boolean('monthly_booking_showing')->default(true);
            $table->boolean('station_booking_showing')->default(true);
            $table->boolean('airport_booking_showing')->default(true);
            $table->boolean('international_booking_showing')->default(true);
            $table->unsignedInteger('free_cancellation_time')->comment('in hours');
            $table->unsignedInteger('partial_cancellation_time')->comment('in hours');
            $table->decimal('partial_cancellation_percentage', 5, 2);
            $table->unsignedInteger('number_days_of_refund');
            $table->decimal('tax_value', 5, 2);
            $table->decimal('riyal_to_points_conversion', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
