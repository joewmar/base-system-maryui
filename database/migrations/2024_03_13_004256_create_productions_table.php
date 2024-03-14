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
        Schema::create('productions', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->bigInteger('feed_type_id')->unsigned()->nullable();
            $table->foreign('feed_type_id')->references('id')->on('feed_types');
            $table->time('runtime_start');
            $table->time('runtime_end');
            $table->integer('tons_produced');
            $table->float('target_tons_hour')->default(0);
            $table->float('prod_target_tons')->default(0);
            $table->bigInteger('quality_assurance_id')->unsigned()->nullable();
            $table->foreign('quality_assurance_id')->references('id')->on('quality_assurances');
            $table->bigInteger('downtime_id')->unsigned()->nullable();
            $table->foreign('downtime_id')->references('id')->on('downtimes');
            $table->time('downtime_start');
            $table->time('downtime_end');
            $table->float('total_hours_operated')->default(0);
            $table->integer('no_of_manpower')->default(0);
            $table->string('remarks')->nullable();
            $table->boolean('active_status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productions');
    }
};
