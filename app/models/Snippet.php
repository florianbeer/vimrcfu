<?php

class Snippet extends BaseModel {
  protected $fillable = ['title', 'description', 'body', 'user_id'];

  public static $rules = [
    'title' => 'required|min:4',
    'body' => 'required',
    'description' => 'required'
    ];

  public function user()
  {
    return $this->belongsTo('User');
  }

  public function comments()
  {
    return $this->hasMany('Comment');
  }

  public function votes()
  {
    return $this->hasMany('Vote');
  }

  public function getScore()
  {
    return $this->votes()->where('snippet_id', '=', $this->id)->sum('score');
  }

  public function hasUserVoted($user_id)
  {
    $vote = $this->votes()->where('user_id', '=', $user_id)->first();
    if ( $vote )
    {
      return (int)$vote->score;
    }
  }

}
