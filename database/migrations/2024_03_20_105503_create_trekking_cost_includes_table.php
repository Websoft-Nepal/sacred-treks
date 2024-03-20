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
        Schema::create('trekking_cost_includes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trekking_id');
            $table->longText('description')->nullable();
            $table->foreign('trekking_id')->references('id')->on('trekkings')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trekking_cost_includes');
    }
};
