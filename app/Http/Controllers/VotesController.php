<?php

namespace App\Http\Controllers;

use App\Models\Snippet;
use App\Models\Vote;
use Illuminate\Support\Facades\Auth;

class VotesController extends Controller
{
    /**
     * Upvote Snippet and return score.
     */
    public function up(Snippet $snippet)
    {
        return $this->vote($snippet, 1);
    }

    /**
     * Downvote Snippet and return score.
     */
    public function down(Snippet $snippet)
    {
        return $this->vote($snippet, -1);
    }

    private function vote(Snippet $snippet, int $score)
    {
        $vote = Vote::firstOrNew([
            'user_id' => Auth::id(),
            'snippet_id' => $snippet->id,
        ]);
        $vote->score = $score;
        $vote->save();

        return response((string) $snippet->score, 200);
    }
}
