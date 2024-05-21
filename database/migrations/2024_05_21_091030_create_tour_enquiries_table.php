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
        Schema::create('tour_enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('tripPackage');
            $table->string('email');
            $table->string('phoneNumber');
            $table->string('startDate');
            $table->string('endDate');
            $table->integer('travellersNo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_enquiries');
    }
};
