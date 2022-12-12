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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('nutritional_plan_id')->nullable();
            $table->unsignedBigInteger('training_plan_id')->nullable();
            $table->longText('my_interests')->nullable();
            $table->longText('about_me')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('name');
            $table->string('surname')->nullable();
            $table->integer('tf_number')->nullable();
            $table->float('weight')->nullable();
            $table->integer('height')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('disabled');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('training_plan_id')->references('id')->on('training_plans');

        });

        Schema::table('nutritional_plans', function(Blueprint $table)
        {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
