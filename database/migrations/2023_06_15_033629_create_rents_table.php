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
        Schema::create('rents', function (Blueprint $table) {
            $table->id();
            $table->date('rent_from_date');
            $table->date('rent_to_date');
            $table->string('rental_status');
            $table->string('rental_number')->default(uniqid());
            $table->foreignId('bike_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->integer('total_rental_price');
            $table->enum('payment_method', ['Online', 'Cash on Hand', 'Credit'])->default('Credit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rents');
    }
};
