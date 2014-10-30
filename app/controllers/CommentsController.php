<?php

class CommentsController extends \BaseController {

  public function __construct()
  {
    $this->beforeFilter('auth', ['only' => ['store', 'edit', 'update']]);
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

    $comment = new Comment();
    $comment->body = Input::get('body');
    $comment->user_id = Auth::user()->id;
    $comment->snippet_id = Input::get('snippet_id');
    $comment->save();

    return Redirect::route('snippet.show', Input::get('snippet_id'));
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
  public function update(Comment $comment)
  {
    if ( Auth::user()->id != $comment->user_id )
    {
      return Redirect::home();
    }

    $validation = Validator::make(Input::all(), Comment::$rules);

    if ( $validation->fails() )
    {
      return Redirect::route('comments.edit')
        ->withErrors($validation)
        ->withInput();
    }

    $comment->body = Input::get('body');
    $comment->save();

    return Redirect::route('snippet.show', Input::get('snippet_id'));
  }

}
