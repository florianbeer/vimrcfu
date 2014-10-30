<?php

class DatabaseSeeder extends Seeder {

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Eloquent::unguard();

    $this->call('SnippetsTableSeeder');
    $this->call('CommentsTableSeeder');
    $this->call('VotesTableSeeder');
    $this->call('UsersTableSeeder');
  }

}
