<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagsController extends Controller
{
    /**
     * Incremental search for Tags,
     * used in autocomplete input field.
     */
    public function search(string $string)
    {
        return Tag::where('name', 'LIKE', '%'.$string.'%')->get();
    }

    /**
     * Returns top Tags array,
     * used in prefetch for autocomplete.
     */
    public function prefetch()
    {
        return Tag::topTags();
    }

    /**
     * Displays all Snippets for a specific Tag.
     */
    public function show(string $slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();

        $snippets = $tag->snippets()->with('comments', 'user')->paginate(10);

        return view('snippets.index', compact('snippets'))
            ->with('title', $tag->name);
    }
}
