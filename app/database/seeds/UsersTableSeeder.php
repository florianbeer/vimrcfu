<?php

use Vimrcfu\Users\User;

class UsersTableSeeder extends Seeder {

  public function run()
  {
    User::create([
      'github_id' => 800047,
      'github_url' => 'https://github.com/florianbeer',
      'avatar_url' => 'https://avatars1.githubusercontent.com/u/800047?v=2',
      'email' => 'fb@42dev.eu',
      'name' => 'Florian Beer'
      ]);

    User::create([
      'github_id' => 1,
      'github_url' => 'https://github.com/octocat',
      'avatar_url' => 'https://avatars1.githubusercontent.com/u/583231?v=2',
      'email' => 'octocat@github.com',
      'name' => 'monalisa octocat'
      ]);

    User::create([
      'github_id' => 75873,
      'github_url' => 'https://github.com/sommero',
      'avatar_url' => 'https://avatars1.githubusercontent.com/u/75873?v=2',
      'email' => 'office@ojs.at',
      'name' => 'Oliver J. Sommer'
      ]);
  }
}
