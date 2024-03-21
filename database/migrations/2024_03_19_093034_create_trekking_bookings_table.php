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
        Schema::create('trekking_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('email');
            $table->enum('status',['verify','unverify'])->default('unverify');
            $table->unsignedBigInteger('trekking_id');
            $table->integer('noOfAdults')->default(0);
            $table->integer('noOfChildren')->default(0);
            $table->string('number');
            $table->string('address')->nullable();
            $table->string('payment');
            $table->double('cost');
            $table->text('message')->nullable();
            $table->foreign('trekking_id')->references('id')->on('trekkings')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trekking_bookings');
    }
};
