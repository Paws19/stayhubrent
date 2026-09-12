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
        Schema::create('new_apartment', function (Blueprint $table) {
            $table->id();
            // Landlord who owns this apartment/property
            $table->foreignId('account_id')
                ->constrained('accounts')
                ->onDelete('cascade');
            // Property information
            $table->string('apartment_name');
            $table->string('room_name');
            $table->string('room_type');
            $table->text('apartment_address');
            // Property image
            $table->string('apartment_image')->nullable();
            // Rental information
            $table->decimal('monthly_rent', 10, 2);
            $table->unsignedInteger('total_beds_in_room');
            $table->unsignedInteger('available_beds_in_room');
            // Amenities
            $table->text('amenities')->nullable();
            // Map location
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new_apartment');
    }
};
