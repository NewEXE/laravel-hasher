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
            $table->unsignedInteger('vocabulary_id');
            $table->unsignedInteger('hash_algorithm_id');
            $table->text('hash_algorithm_key');
            $table->text('hash');
            $table->timestamps();
            $table->foreign('vocabulary_id')->references('id')->on('vocabulary');
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
