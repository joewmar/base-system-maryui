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
        Schema::create('farm_locations', function (Blueprint $table) {
            $table->id();
            $table->string('farm_location', 255);
            $table->bigInteger('farm_id')->unsigned()->nullable();
            $table->foreign('farm_id')->references('id')->on('farms');
            $table->boolean('active_status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farm_locations');
    }
};
