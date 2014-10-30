<?php

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
      'github_id' => 2723,
      'github_url' => 'https://github.com/holman',
      'avatar_url' => 'https://avatars2.githubusercontent.com/u/2723?v=2',
      'email' => 'zach@zachholman.com',
      'name' => 'Zach Holman'
      ]);
  }
}
