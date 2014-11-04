<?php

use Faker\Factory as Faker;
use Vimrcfu\Comments\Comment;

class CommentsTableSeeder extends Seeder {

  public function run()
  {
    $faker = Faker::create();

    foreach(range(1,100) as $index)
    {
      Comment::create([
        'body' => $faker->paragraph(),
        'snippet_id' => $faker->numberBetween(1, 100),
        'user_id' => $faker->randomElement([1,2,3]),
        'created_at' => $faker->dateTimeThisMonth(),
        'updated_at' => $faker->dateTimeThisMonth()
        ]);
    }
  }
}
