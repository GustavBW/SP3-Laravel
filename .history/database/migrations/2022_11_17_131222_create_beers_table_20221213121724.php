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
        Schema::create('beers', function (Blueprint $table) {
            $table->id();
            $table->integer('max_speed');
            $table->bigInteger('recipe_id') -> references('id')->on('recipe');
            $table->integer('optimal_production_speed');
            $table->enum('type', ['pilsner', 'wheat', 'ipa', 'stout', 'ale', 'alcohol free']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beers');
    }
};
