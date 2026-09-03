<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
     Schema::create('payment_history', function (Blueprint $table) {
        $table->id();

        // Tenant who made the payment
        $table->foreignId('account_id')
          ->constrained('accounts')
          ->onDelete('cascade');

        // Landlord/property associated with the payment
        $table->foreignId('landlord_id')
          ->constrained('landlord_details')
          ->onDelete('cascade');

        // Payment information
        $table->string('transaction_id')->unique();
        $table->decimal('amount', 10, 2);
        $table->string('payment_method');
        $table->string('status');

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_history');
    }
};
