<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSnippetsTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('snippets' , function($t) {
      $t->create();

      $t->increments('id');
      $t->string('title');
      $t->text('body');
      $t->text('description');
      $t->integer('user_id');

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
    Schema::drop('snippets');
  }

}
