<?php

class VotesController extends \BaseController {

  public function __construct()
  {
    $this->beforeFilter('auth', ['only' => ['up', 'down']]);
  }

	public function up($id)
	{
    $vote = Vote::findOrCreate(Auth::user()->id, $id);
    $vote->user_id = Auth::user()->id;
    $vote->snippet_id = $id;
    $vote->score = 1;
    $vote->save();

    $score = Snippet::find($id)->getScore();
    return Response::make($score, 200);; 
	}

	public function down($id)
	{
    $vote = Vote::findOrCreate(Auth::user()->id, $id);
    $vote->user_id = Auth::user()->id;
    $vote->snippet_id = $id;
    $vote->score = -1;
    $vote->save();

    $score = Snippet::find($id)->getScore();
    return Response::make($score, 200);; 
	}


}
