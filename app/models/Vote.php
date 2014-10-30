<?php

class Vote extends Eloquent {
  protected $fillable = ['snippet_id', 'user_id'];

  public static $rules = [
    'snippet_id' => 'required|unique:votes,snippet_id,NULL,id,user_id,{$user_id}'
    ];

  public static function findOrCreate($user_id, $snippet_id)
  {
    $obj = static::where('user_id', '=', $user_id)
      ->where('snippet_id', '=', $snippet_id)->first();

    return $obj ?: new static();
  }

  public function user()
  {
    return $this->belongsTo('User');
  }

  public function snippet()
  {
    return $this->belongsTo('Snippet');
  }

}
