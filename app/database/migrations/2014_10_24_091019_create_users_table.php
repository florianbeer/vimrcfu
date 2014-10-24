<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
    Schema::table('users', function($t) {
      $t->create();

      $t->increments('id');
      $t->string('github_id');
      $t->string('github_url');
      $t->string('avatar_url');
      $t->string('email')->nullable();
      $t->string('name');

      $t->rememberToken();
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
    Schema::drop('users');
	}

}
