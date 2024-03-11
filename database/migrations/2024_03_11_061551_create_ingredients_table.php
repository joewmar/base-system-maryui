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
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->bigInteger('material_id')->unsigned()->nullable();
            $table->foreign('material_id')->references('id')->on('materials');
            $table->bigInteger('feed_type_id')->unsigned()->nullable();
            $table->foreign('feed_type_id')->references('id')->on('feed_types');
            $table->float('standard')->default(0)->nullable();
            $table->float('batch')->default(0)->nullable();
            $table->float('adjustment')->default(0)->nullable();
            $table->boolean('active_status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredients');
    }
};
