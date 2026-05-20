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
       Schema::create('landlord_details', function (Blueprint $table) {
            $table->id();

            $table->foreignId('account_id')
                ->unique()
                ->constrained('accounts')
                ->onDelete('cascade');

            $table->text('property_name')->nullable();

            $table->enum('property_type', [
                'boarding_house',
                'apartment',
                'dormitory',
                'bedspace',
                'studio_unit',
            ])->nullable();

            $table->unsignedInteger('number_of_floors')->nullable();
            $table->unsignedInteger('number_of_rooms')->nullable();
            $table->unsignedInteger('bed_per_room')->nullable();

            $table->decimal('monthly_rent', 10, 2)->nullable();

            $table->text('full_address')->nullable();

            $table->json('amenities')->nullable();

            $table->text('house_rules')->nullable();

            $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landlord_details');
    }
};
