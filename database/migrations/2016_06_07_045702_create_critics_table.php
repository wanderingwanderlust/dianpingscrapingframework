<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCriticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('critic', function (Blueprint $table) {
            $table->increments('id');
            $table->string('body');
            $table->string('author_id');
            $table->date('date');
            $table->string('original_grade');
            $table->boolean('liked');
            $table->string('venue');
            $table->string('source_id');
            $table->string('language')
            $table->char('mdhash');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('critic');
    }
}
