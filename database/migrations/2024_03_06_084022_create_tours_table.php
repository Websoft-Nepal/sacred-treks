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
            $table->string('featureimg1')->nullable();
            $table->string('featureimg2')->nullable();
            $table->string('map')->nullable();
            $table->unsignedBigInteger('count')->default(0);
            $table->string('start')->nullable();
            $table->string('finish')->nullable();
            $table->string('type')->nullable();
            $table->string('grade')->nullable();
            $table->string('group_size')->nullable();
            $table->string('max_altitude')->nullable();
            $table->string('duration');
            $table->string('place');
            $table->double('cost')->default(0);
            $table->enum('boundary', ['national', 'international'])->default('national');
            $table->unsignedBigInteger('transportation_id');
            $table->longText('description')->nullable();
            $table->foreign('transportation_id')->references('id')->on('tour_transportations')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
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
