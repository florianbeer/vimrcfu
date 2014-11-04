<?php namespace Vimrcfu\Comments;

use Eloquent;

class Comment extends Eloquent {
  protected $fillable = ['body', 'user_id', 'comment_id'];

  public function snippet()
  {
    return $this->belongsTo('Vimrcfu\Snippets\Snippet');
  }

  public function user()
  {
    return $this->belongsTo('Vimrcfu\Users\User');
  }

}
