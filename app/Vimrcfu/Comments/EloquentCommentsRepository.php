<?php namespace Vimrcfu\Comments;

use Auth;
use Vimrcfu\Validation\CommentValidator;

class EloquentCommentsRepository implements CommentsRepository {

  /**
   * @var Vimrcfu\Validation\CommentValidator
   */
  protected $validator;

  /**
   * @param Vimrcfu\Validation\CommentValidator $validator
   */
  public function __construct(CommentValidator $validator)
  {
    $this->validator = $validator;
  }

  /**
   * @param array $input
   * @return mixed
   */
  public function create($input)
  {
    $this->validator->validate($input);

    $comment = new Comment();
    $comment->body = $input['body'];
    $comment->user_id = Auth::user()->id;
    $comment->snippet_id = $input['snippet_id'];
    $comment->save();

    return $comment;
  }

  /**
   * @param Vimrcfu\Snippets\Comment $comment
   * @param array $input
   * @return mixed
   */
  public function update(Comment $comment, $input)
  {
    $this->validator->validate($input);

    $comment->body = $input['body'];
    $comment->save();

    return $comment;
  }

}
