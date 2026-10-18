<?php

namespace App\Http\Controllers;

use App\Models\Snippet;
use App\Models\User;

class UsersController extends Controller
{
    /**
     * Shows a User with all Tags and paginated Snippets.
     */
    public function show(User $user)
    {
        return view('users.show', [
            'user' => $user,
            'snippets' => $user->snippets()->with('comments', 'user')->simplePaginate(10),
            'total' => $user->snippets()->count(),
            'tags' => $user->tags(),
        ]);
    }

    /**
     * Shows a User's upvoted Snippets.
     */
    public function upvotes(User $user)
    {
        $snippets = Snippet::select('snippets.*')
            ->where('user_id', '!=', $user->id)
            ->whereHas('votes', function ($query) use ($user) {
                $query->where('user_id', $user->id)->where('score', 1);
            })
            ->orderByDesc('created_at')
            ->with('comments', 'user')
            ->simplePaginate(10);

        return view('users.show', [
            'user' => $user,
            'snippets' => $snippets,
            'total' => $user->snippets()->count(),
            'tags' => $user->tags(),
        ]);
    }
}
