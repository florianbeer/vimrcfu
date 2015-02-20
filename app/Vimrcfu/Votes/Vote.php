<?php namespace Vimrcfu\Votes;

use Eloquent;

class Vote extends Eloquent {
  protected $fillable = ['snippet_id', 'user_id'];

  public function user()
  {
    return $this->belongsTo('Vimrcfu\Users\User');
  }

  public function snippet()
  {
    return $this->belongsTo('Vimrcfu\Snippets\Snippet');
  }

}
