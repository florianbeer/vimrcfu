<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Snippet;
use App\Models\Tag;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(10)->create();

        $snippets = Snippet::factory(30)
            ->recycle($users)
            ->create();

        Comment::factory(60)
            ->recycle($users)
            ->recycle($snippets)
            ->create();

        foreach ($snippets as $snippet) {
            foreach ($users->random(rand(1, 5)) as $user) {
                $vote = Vote::firstOrNew([
                    'user_id' => $user->id,
                    'snippet_id' => $snippet->id,
                ]);
                $vote->score = rand(0, 4) ? 1 : -1;
                $vote->save();
            }

            Tag::updateTags($snippet, collect(['mappings', 'settings', 'colors', 'plugins', 'search', 'movement'])
                ->random(rand(1, 3))
                ->implode(','));
        }
    }
}
