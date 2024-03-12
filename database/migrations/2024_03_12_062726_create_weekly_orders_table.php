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
        Schema::create('weekly_orders', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->bigInteger('material_id')->unsigned()->nullable();
            $table->foreign('material_id')->references('id')->on('materials');
            $table->float('price_per_kgs')->default(0);
            $table->double('inv_cost')->default(0);
            $table->float('kgs_per_bag')->default(0);
            $table->float('deliveries_today')->default(0);
            $table->float('no_of_working')->default(0);
            $table->float('standard_days')->default(0);
            $table->boolean('active_status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weekly_orders');
    }
};
