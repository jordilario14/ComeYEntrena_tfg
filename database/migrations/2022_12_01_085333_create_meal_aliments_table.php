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
        Schema::create('meal_aliments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("meal_id");
            $table->unsignedBigInteger("aliment_id");
            $table->float("cuantity");
            $table->timestamps();

            $table->foreign('meal_id')->references('id')->on('meals');
            $table->foreign('aliment_id')->references('id')->on('aliments');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meal_aliments');
    }
};
