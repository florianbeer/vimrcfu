<?php

use Faker\Factory as Faker;

Class SnippetsTableSeeder extends Seeder { 
  
  public function run()
  {
    $faker = Faker::create();

    foreach(range(1, 50) as $index)
    {
      Snippet::create([
        'title' => $faker->word,
        'body' => $faker->paragraph,
        'description' => $faker->paragraph,
        'user_id' => 1
        ]);
    }
  }
}
