<?php

namespace App\Http\Controllers;

use App\Http\Requests\SnippetRequest;
use App\Models\Snippet;
use App\Models\Tag;
use App\Models\Vote;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SnippetsController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth', only: ['create', 'store', 'edit', 'update']),
        ];
    }

    /**
     * Displays all Snippets paginated.
     */
    public function index()
    {
        $snippets = Snippet::with('comments', 'user')->orderByDesc('id')->paginate(10);

        return view('snippets.index', compact('snippets'));
    }

    /**
     * Displays the highest voted Snippets.
     */
    public function hot()
    {
        $snippets = Snippet::select('snippets.*')
            ->rightJoin('votes', 'votes.snippet_id', '=', 'snippets.id')
            ->orderBy(DB::raw('sum(score)'), 'DESC')
            ->orderBy('snippets.created_at', 'DESC')
            ->groupBy('snippets.id')
            ->havingRaw('sum(score) > 1')
            ->with('comments', 'user')
            ->paginate(10);

        return view('snippets.index', compact('snippets'))
            ->with('title', 'Hot Snippets');
    }

    /**
     * Shows the form for creating a new Snippet.
     */
    public function create()
    {
        return view('snippets.create', ['snippet' => new Snippet]);
    }

    /**
     * Stores a new Snippet.
     */
    public function store(SnippetRequest $request)
    {
        $snippet = Snippet::create([
            ...$request->safe()->only(['title', 'body', 'description']),
            'user_id' => Auth::id(),
        ]);

        Tag::updateTags($snippet, $request->input('tags'));

        $vote = new Vote(['user_id' => Auth::id(), 'snippet_id' => $snippet->id]);
        $vote->score = 1;
        $vote->save();

        return redirect()->route('snippet.show', $snippet);
    }

    /**
     * Displays a Snippet.
     */
    public function show(Snippet $snippet)
    {
        return view('snippets.show', compact('snippet'));
    }

    /**
     * Shows the form for editing a Snippet.
     */
    public function edit(Snippet $snippet)
    {
        if (Auth::id() != $snippet->user_id) {
            return redirect()->route('home');
        }

        return view('snippets.edit', compact('snippet'));
    }

    /**
     * Updates a Snippet in storage.
     */
    public function update(SnippetRequest $request, Snippet $snippet)
    {
        if (Auth::id() != $snippet->user_id) {
            return redirect()->route('home');
        }

        $snippet->update($request->safe()->only(['title', 'body', 'description']));

        Tag::updateTags($snippet, $request->input('tags'));

        return redirect()->route('snippet.show', $snippet);
    }
}
