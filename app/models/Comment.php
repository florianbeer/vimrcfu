<?php

class Comment extends BaseModel {
  protected $fillable = ['body', 'user_id', 'comment_id'];

  public static $rules = [
    'body' => 'required|min:4'
    ];

  public function snippet()
  {
    return $this->belongsTo('Snippet');
  }

  public function user()
  {
    return $this->belongsTo('User');
  }

}
