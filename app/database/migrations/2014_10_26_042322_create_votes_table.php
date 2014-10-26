<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
    Schema::table('votes', function($t) {
      $t->create();

      $t->increments('id');
      $t->integer('user_id')->unsigned();
      $t->integer('snippet_id')->unsigned();
      $t->tinyInteger('score');
      $t->unique(['user_id', 'snippet_id']);

      $t->timestamps();
    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
    Schema::drop('votes');
	}

}
