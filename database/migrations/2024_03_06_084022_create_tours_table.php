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
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->boolean('status')->default(true);
            $table->string('image');
            $table->string('map')->nullable();
            $table->string('duration');
            $table->string('place');
            $table->double('cost')->default(0);
            $table->enum('boundary', ['national', 'international'])->default('national');
            $table->unsignedBigInteger('transportation_id');
            $table->longText('description')->nullable();
            $table->foreign('transportation_id')->references('id')->on('tour_transportations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
