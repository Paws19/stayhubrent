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
        Schema::create('tenant_details', function (Blueprint $table) {
            $table->id();

            $table->foreignId('account_id')
                ->unique()
                ->constrained('accounts')
                ->onDelete('cascade');

            $table->date('birthday')->nullable();

            $table->enum('gender', [
                'male',
                'female',
                'other'
            ])->nullable();

            $table->text('occupation_or_school')->nullable();

            $table->text('preferred_location')->nullable();

            $table->decimal('min_budget', 10, 2)->nullable();

            $table->decimal('max_budget', 10, 2)->nullable();

            $table->enum('room_type_preference', [
                'private',
                'shared',
                'bedspace',
                'studio_unit',
                'anytype'
            ])->nullable();

            $table->json('tenant_wants_amenities')->nullable();

            $table->text('emergency_contact_name')->nullable();

            $table->text('emergency_contact_number')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_details');
    }
};
