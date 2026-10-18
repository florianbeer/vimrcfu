<?php

namespace App\Http\Controllers;

use App\Models\Snippet;

class FeedController extends Controller
{
    /**
     * Shows RSS feed for the last 20 Snippets.
     */
    public function index()
    {
        $snippets = Snippet::with('user')->orderByDesc('id')->take(20)->get();

        return response()
            ->view('pages.feed', compact('snippets'))
            ->header('Content-Type', 'application/rss+xml');
    }
}
