<?php

class Vote extends Eloquent {
  protected $fillable = ['snippet_id', 'user_id'];

  public static $rules = [
    'snippet_id' => 'required|unique:votes,snippet_id,NULL,id,user_id,{$user_id}'
    ];

  public function user()
  {
    return $this->belongsTo('User');
  }

  public function snippet()
  {
    return $this->belongsTo('Snippet');
  }

}
