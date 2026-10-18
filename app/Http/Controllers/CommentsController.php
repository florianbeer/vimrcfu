<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    /**
     * Stores a new Comment.
     */
    public function store(CommentRequest $request)
    {
        $comment = Comment::create([
            'body' => $request->validated('body'),
            'snippet_id' => $request->validated('snippet_id'),
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('snippet.show', $comment->snippet_id);
    }

    /**
     * Shows the form for editing a Comment.
     */
    public function edit(Comment $comment)
    {
        if (Auth::id() != $comment->user_id) {
            return redirect()->route('home');
        }

        return view('comments.edit', compact('comment'));
    }

    /**
     * Updates a Comment in storage.
     */
    public function update(CommentRequest $request, Comment $comment)
    {
        if (Auth::id() != $comment->user_id) {
            return redirect()->route('home');
        }

        $comment->update(['body' => $request->validated('body')]);

        return redirect()->route('snippet.show', $comment->snippet_id);
    }
}
