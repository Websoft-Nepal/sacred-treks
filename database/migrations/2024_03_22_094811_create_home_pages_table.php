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
        Schema::create('home_pages', function (Blueprint $table) {
            $table->id();
            $table->string('heading');
            $table->text('subheading');
            $table->string('headimg1');
            $table->string('headimg2');
            $table->string('bookimg');
            $table->string('gallery_title');
            $table->string('trekking_title');
            $table->text('trekking_slogan');
            $table->string('tour_title');
            $table->text('tour_slogan');
            $table->string('feature_title');
            $table->text('footer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_pages');
    }
};
