<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EnableSnippetsFulltextSearch extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
    DB::statement('ALTER TABLE snippets ENGINE=MyISAM');
    DB::statement('ALTER TABLE snippets ADD FULLTEXT search(title, body, description)');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
    Schema::table('snippets', function($table) {
      $table->dropIndex('search');
    });

    DB::statement('ALTER TABLE snippets ENGINE:InnoDB');
	}

}
