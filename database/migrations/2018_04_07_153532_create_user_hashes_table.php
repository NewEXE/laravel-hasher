<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserHashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_hashes', function (Blueprint $table) {
            $table->increments('id');
            $table->text('hash_algorithm_key');
            $table->text('hash');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('word_id');
            $table->unsignedInteger('hash_algorithm_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('word_id')->references('id')->on('vocabulary');
            $table->foreign('hash_algorithm_id')->references('id')->on('hash_algorithms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_hashes');
    }
}
