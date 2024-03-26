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
        Schema::create('trekkings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->boolean('status')->default(true);
            $table->string('image');
            $table->string('featureimg1')->nullable();
            $table->string('featureimg2')->nullable();
            $table->string('duration');
            $table->unsignedBigInteger('count')->default(0);
            $table->double('cost')->default(0);
            $table->unsignedBigInteger('location_id');
            $table->string('slug');
            $table->foreign('location_id')->references('id')->on('trekking_locations')->onDelete('cascade');
            $table->longText('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trekkings');
    }
};
