<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finished_batches', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('batch_id')->references('id')->on('batches');
            $table->integer('successful_products');
            $table->integer('failed_products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('queued_batches');
    }
};
