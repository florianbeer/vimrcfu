<?php

namespace Tests\Feature;

use App\Models\Snippet;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticatedActionsTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_a_snippet(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post('/snippet', [
                'title' => 'Relative line numbers',
                'description' => 'Enables relative line numbers.',
                'body' => 'set relativenumber',
                'tags' => 'settings,numbers',
            ])
            ->assertRedirect();

        $snippet = Snippet::first();
        $this->assertSame('Relative line numbers', $snippet->title);
        $this->assertSame($user->id, $snippet->user_id);
        $this->assertSame(1, $snippet->score);
        $this->assertEqualsCanonicalizing(['settings', 'numbers'], $snippet->tagnames());
    }

    public function test_validation_errors_redirect_back(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->from('/snippet/create')
            ->post('/snippet', ['title' => 'ab'])
            ->assertRedirect('/snippet/create')
            ->assertSessionHasErrors(['title', 'body', 'description']);
    }

    public function test_user_can_update_own_snippet(): void
    {
        $snippet = Snippet::factory()->create();

        $this->actingAs($snippet->user)
            ->put('/snippet/'.$snippet->id, [
                'title' => 'Updated title',
                'description' => $snippet->description,
                'body' => $snippet->body,
                'tags' => '',
            ])
            ->assertRedirect('/snippet/'.$snippet->id);

        $this->assertSame('Updated title', $snippet->fresh()->title);
    }

    public function test_user_cannot_update_others_snippet(): void
    {
        $snippet = Snippet::factory()->create();
        $other = User::factory()->create();

        $this->actingAs($other)
            ->put('/snippet/'.$snippet->id, [
                'title' => 'Hijacked title',
                'description' => 'x',
                'body' => 'x',
            ])
            ->assertRedirect('/');

        $this->assertNotSame('Hijacked title', $snippet->fresh()->title);
    }

    public function test_user_can_comment(): void
    {
        $snippet = Snippet::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post('/comment', [
                'body' => 'Great snippet, thanks!',
                'snippet_id' => $snippet->id,
            ])
            ->assertRedirect('/snippet/'.$snippet->id);

        $this->assertSame(1, $snippet->comments()->count());
    }

    public function test_user_can_vote(): void
    {
        $snippet = Snippet::factory()->create();
        $voter = User::factory()->create();

        $this->actingAs($voter)
            ->get('/snippet/'.$snippet->id.'/up')
            ->assertOk()
            ->assertSee('1');

        $this->actingAs($voter)
            ->get('/snippet/'.$snippet->id.'/down')
            ->assertOk();

        $this->assertSame(-1, $snippet->fresh()->score);
    }

    public function test_vote_is_unique_per_user_and_snippet(): void
    {
        $snippet = Snippet::factory()->create();
        $voter = User::factory()->create();

        $this->actingAs($voter)->get('/snippet/'.$snippet->id.'/up');
        $this->actingAs($voter)->get('/snippet/'.$snippet->id.'/up');

        $this->assertSame(1, $snippet->votes()->where('user_id', $voter->id)->count());
    }

    public function test_logout(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get('/logout')->assertRedirect('/');
        $this->assertGuest();
    }
}
