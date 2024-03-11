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
        Schema::create('feed_types', function (Blueprint $table) {
            $table->id();
            $table->string('feed_type_name');
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
        Schema::dropIfExists('feed_types');
    }
};
