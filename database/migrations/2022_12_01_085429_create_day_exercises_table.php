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
        Schema::create('day_exercises', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("day_id");
            $table->unsignedBigInteger("exercise_id");
            $table->integer("series");
            $table->integer("repetitions");
            $table->string("rir");
            $table->timestamps();

            $table->foreign('day_id')->references('id')->on('days');
            $table->foreign('exercise_id')->references('id')->on('exercises');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('day_exercises');
    }
};
