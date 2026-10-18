<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Snippet;
use App\Models\Tag;
use App\Models\Vote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    private function seedContent(): Snippet
    {
        $snippet = Snippet::factory()->create();
        Comment::factory()->for($snippet)->create();

        $vote = new Vote(['user_id' => $snippet->user_id, 'snippet_id' => $snippet->id]);
        $vote->score = 1;
        $vote->save();

        Tag::updateTags($snippet, 'mappings,settings');

        return $snippet;
    }

    public function test_home_page_renders(): void
    {
        $this->seedContent();

        $this->get('/')->assertOk()->assertSee('New Snippets');
    }

    public function test_snippet_index_renders(): void
    {
        $snippet = $this->seedContent();

        $this->get('/snippet')->assertOk()->assertSee($snippet->title);
    }

    public function test_hot_snippets_render(): void
    {
        $this->seedContent();

        $this->get('/snippet/hot')->assertOk();
    }

    public function test_snippet_page_renders(): void
    {
        $snippet = $this->seedContent();

        $this->get('/snippet/'.$snippet->id)
            ->assertOk()
            ->assertSee($snippet->title)
            ->assertSee($snippet->user->name);
    }

    public function test_user_page_renders(): void
    {
        $snippet = $this->seedContent();

        $this->get('/user/'.$snippet->user_id)->assertOk()->assertSee($snippet->user->name);
    }

    public function test_user_upvotes_page_renders(): void
    {
        $snippet = $this->seedContent();

        $this->get('/user/'.$snippet->user_id.'/upvotes')->assertOk();
    }

    public function test_tag_page_renders(): void
    {
        $snippet = $this->seedContent();

        $this->get('/tag/mappings')->assertOk()->assertSee($snippet->title);
    }

    public function test_tag_prefetch_returns_json(): void
    {
        $this->seedContent();

        $this->get('/tag/prefetch')->assertOk()->assertJsonFragment(['name' => 'mappings']);
    }

    public function test_feed_renders(): void
    {
        $snippet = $this->seedContent();

        $this->get('/feed')
            ->assertOk()
            ->assertHeader('Content-Type', 'application/rss+xml');
    }

    public function test_sitemap_renders(): void
    {
        $this->seedContent();

        $this->get('/sitemap.xml')->assertOk();
    }

    public function test_faq_renders(): void
    {
        $this->get('/faq')->assertOk();
    }

    public function test_guests_are_redirected_to_login(): void
    {
        $snippet = $this->seedContent();

        $this->get('/snippet/create')->assertRedirect('/login');
        $this->post('/snippet', [])->assertRedirect('/login');
        $this->get('/snippet/'.$snippet->id.'/up')->assertRedirect('/login');
    }

    public function test_login_redirects_to_github(): void
    {
        config(['services.github.client_id' => 'test-client-id']);

        $response = $this->get('/login');

        $response->assertRedirect();
        $this->assertStringContainsString('github.com', $response->headers->get('Location'));
    }
}
