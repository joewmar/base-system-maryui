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
        Schema::create('premixes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('feed_type_id')->unsigned()->nullable();
            $table->foreign('feed_type_id')->references('id')->on('feed_types');
            $table->float('beginning')->default(0);
            $table->boolean('active_status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('premixes');
    }
};
