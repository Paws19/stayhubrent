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
         Schema::create('tenant_assign_apartment', function (Blueprint $table) {
            $table->id();

            // Tenant
            $table->foreignId('account_id')
                ->constrained('accounts')
                ->onDelete('cascade');

            // Apartment
            $table->foreignId('apartment_id')
                ->constrained('landlord_details')
                ->onDelete('cascade');

            // Assignment information
            $table->date('move_in_date')->nullable();
            $table->date('move_out_date')->nullable();

            // active = currently renting
            // ended = no longer renting
            $table->enum('status', ['active', 'ended'])
                ->default('active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_assign_apartment');
    }
};
