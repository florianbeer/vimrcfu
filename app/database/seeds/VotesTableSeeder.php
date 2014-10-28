<?php

Class VotesTableSeeder extends Seeder {

  public function run()
  {
    foreach(Snippet::all() as $snippet)
    {
      Vote::create([
        'user_id' => $snippet->user_id,
        'snippet_id' => $snippet->id,
        'score' => 1
        ]);
    }
  }
}

