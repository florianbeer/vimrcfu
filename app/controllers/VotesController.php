<?php

use Vimrcfu\Votes\Vote;
use Vimrcfu\Snippets\Snippet;

class VotesController extends \BaseController {

  public function __construct()
  {
    $this->beforeFilter('auth', ['only' => ['up', 'down']]);
  }

  /**
   * Upvote Snippet and return score.
   *
   * @param string $snippet_id
   * @return mixed
   */
  public function up($snippet_id)
  {
    $vote = Vote::firstOrNew([
      'user_id'     => Auth::user()->id,
      'snippet_id'  => $snippet_id
      ]);
    $vote->score = 1;
    $vote->save();

    $score = Snippet::find($snippet_id)->score;

    return Response::make($score, 200);;
  }

  /**
   * Downvote Snippet and return score.
   *
   * @param string $snippet_id
   * @return mixed
   */
  public function down($snippet_id)
  {
    $vote = Vote::firstOrNew([
      'user_id'     => Auth::user()->id,
      'snippet_id'  => $snippet_id
      ]);
    $vote->score = -1;
    $vote->save();

    $score = Snippet::find($snippet_id)->score;

    return Response::make($score, 200);;
  }

}
