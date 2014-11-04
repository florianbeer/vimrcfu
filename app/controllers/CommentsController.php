<?php

use Vimrcfu\Comments\Comment;
use Vimrcfu\Comments\CommentsRepository;

class CommentsController extends \BaseController {

  /**
   * @var Vimrcfu\Comments\CommentsRepository
   */
  private $repository;

  /**
   * @param Vimrcfu\Comments\CommentsRepository $repository
   */
  public function __construct(CommentsRepository $repository)
  {
    $this->beforeFilter('auth', ['only' => ['store', 'edit', 'update']]);
    $this->repository = $repository;
  }

  /**
   * Stores new Comment in storage.
   *
   * @return mixed
   */
  public function store()
  {
    $comment = $this->repository->create(Input::all());

    return Redirect::route('snippet.show', $comment->snippet->id);
  }

  /**
   * Shows the form for editing a Comment.
   *
   * @param Vimrcfu\Comments\Comment $comment
   * @return mixed
   */
  public function edit(Comment $comment)
  {
    if ( Auth::user()->id != $comment->user_id )
    {
      return Redirect::home();
    }

    return View::make('comments.edit', compact('comment'));
  }

  /**
   * Update a Comment in storage.
   *
   * @param  Vimrcfu\Comments\Comment $comment
   * @return mixed
   */
  public function update(Comment $comment)
  {
    if ( Auth::user()->id != $comment->user_id )
    {
      return Redirect::home();
    }

    $comment = $this->repository->update($comment, Input::all());

    return Redirect::route('snippet.show', $comment->snippet->id);
  }

}
