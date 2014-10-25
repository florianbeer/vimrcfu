<?php

class CommentsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
  {
    $validation = Validator::make(Input::all(), Comment::$rules);

    if( $validation->fails() )
    {
      return Redirect::route('snippet.show', Input::get('snippet_id'))
        ->withErrors($validation)
        ->withInput();
    }

    $comment = new Comment;
    $comment->body = Input::get('body');
    $comment->user_id = Auth::user()->id;
    $comment->snippet_id = Input::get('snippet_id');
    $comment->save();

    return Redirect::route('snippet.show', Input::get('snippet_id'));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param Comment $comment 
	 * @return Response
	 */
	public function edit($comment)
	{
    if ( Auth::user()->id != $comment->user_id )
    {
      return Redirect::home();
    }

    return View::make('comments.edit')
      ->withComment($comment);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Comment $comment
	 * @return Response
	 */
	public function update($comment)
	{
    $validation = Validator::make(Input::all(), Comment::$rules);

    if ( $validation->fails() )
    {
      return Redirect::route('comments.edit')
        ->withErrors($validation)
        ->withInput();
    }

    $comment->body = Input::get('body');
    $comment->save();

    return Redirect('snippet.show', Input::get('snippet_id'));
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
