<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Snippet;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    /**
     * Displays the home page.
     */
    public function home()
    {
        $topSnippet = (object) Cache::remember('topSnippet', 300, function () {
            $result = DB::select('
                SELECT snippets.id, sum(votes.score) points FROM snippets
                JOIN votes ON snippets.id = votes.snippet_id
                GROUP BY snippets.id ORDER BY points DESC, snippets.id DESC LIMIT 1'
            );

            return (array) ($result[0] ?? []);
        });

        $topCommented = (object) Cache::remember('topComment', 300, function () {
            $result = DB::select('
                SELECT snippets.id, count(comments.id) comments_count FROM snippets
                JOIN comments ON snippets.id = comments.snippet_id
                GROUP BY snippet_id ORDER BY comments_count DESC LIMIT 1'
            );

            return (array) ($result[0] ?? []);
        });

        return view('pages.home', [
            'snippets' => Snippet::with('comments', 'user')->orderByDesc('id')->take(5)->get(),
            'snippets_count' => Cache::remember('snippetsCount', 300, fn () => Snippet::count()),
            'comments_count' => Cache::remember('commentsCount', 300, fn () => Comment::count()),
            'users_count' => Cache::remember('usersCount', 300, fn () => User::count()),
            'top_snippet' => $topSnippet,
            'top_comments' => $topCommented,
            'tags' => Tag::topTags(),
            'title' => 'Popular Tags',
        ]);
    }

    /**
     * Displays Frequently Asked Questions.
     */
    public function faq()
    {
        return view('pages.markdown', [
            'title' => 'Frequently Asked Questions',
            'file' => 'faq',
        ]);
    }

    /**
     * Displays the XML sitemap.
     */
    public function sitemap()
    {
        return response()
            ->view('pages.sitemap', [
                'static' => ['faq', 'search', 'snippet'],
                'snippets' => Snippet::all(),
                'tags' => Tag::all(),
                'users' => User::all(),
            ])
            ->header('Content-Type', 'application/xml');
    }
}
