<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\UserWalletEnum;
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_wallet_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->decimal('value', 12, 2);
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
            $table->enum('type', array_column(UserWalletEnum::cases(), 'value'))->default(UserWalletEnum::Payment->value);
            $table->unsignedBigInteger('order_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_wallet_transactions');
    }
};
