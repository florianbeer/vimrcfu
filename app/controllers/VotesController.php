<?php

use Vimrcfu\Snippets\Snippet;

class VotesController extends \BaseController {

  public function __construct()
  {
    $this->beforeFilter('auth', ['only' => ['up', 'down']]);
  }

  /**
   * Upvote Snippet and return score
   *
   * @param string $id
   * @return void
   * @author Florian Beer
   */
  public function up($id)
  {
    $vote = Vote::firstOrCreate(['user_id' => Auth::user()->id, 'snippet_id' => $id]);
    $vote->user_id = Auth::user()->id;
    $vote->snippet_id = $id;
    $vote->score = 1;
    $vote->save();

    $score = Snippet::find($id)->score;

    return Response::make($score, 200);;
  }

  /**
   * Downvore Snippet and return score
   *
   * @param string $id
   * @return void
   * @author Florian Beer
   */
  public function down($id)
  {
    $vote = Vote::firstOrCreate(['user_id' => Auth::user()->id, 'snippet_id' => $id]);
    $vote->user_id = Auth::user()->id;
    $vote->snippet_id = $id;
    $vote->score = -1;
    $vote->save();

    $score = Snippet::find($id)->score;

    return Response::make($score, 200);;
  }

}
