<?php

use Faker\Factory as Faker;
use Vimrcfu\Snippets\Snippet;

class SnippetsTableSeeder extends Seeder {

  public function run()
  {
    $faker = Faker::create();

    foreach(range(1, 100) as $index)
    {
      $snippet = Snippet::create([
        'title' => $faker->word,
        'body' => $faker->paragraph,
        'description' => $faker->paragraph,
        'user_id' => $faker->randomElement([1,2,3])
        ]);
    }
  }
}
