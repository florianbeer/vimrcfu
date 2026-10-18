<?php

namespace App\Http\Controllers;

use App\Models\Snippet;
use App\Models\Tag;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Shows the search page or redirects to Snippets
     * index page in case no searchterm was entered.
     */
    public function index(Request $request)
    {
        $search = $request->query('q');

        if (empty($search)) {
            return redirect()->route('snippet.index');
        }

        $snippets = Snippet::query()
            ->selectRaw('snippets.*, MATCH (title) AGAINST (?) title_relevance, MATCH (title, body, description) AGAINST (?) relevance', [$search, $search])
            ->whereFullText(['title', 'body', 'description'], $search, ['mode' => 'boolean'])
            ->orderByDesc('title_relevance')
            ->orderByDesc('relevance')
            ->with('comments', 'user')
            ->paginate(10)
            ->appends(['q' => $search]);

        $tags = Tag::where('name', 'LIKE', '%'.$search.'%')->take(20)->get();

        return view('search.index', [
            'snippets' => $snippets,
            'total' => $snippets->total(),
            'tags' => $tags,
        ]);
    }
}
