<?php

class Snippet extends Eloquent {
  protected $fillable = ['title', 'description', 'body', 'user_id'];
  protected $appends = array('score');

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

  public function getScoreAttribute()
  {
    return $this->votes()->sum('score');
  }

  public function hasUserVoted($user_id)
  {
    $vote = $this->votes()->where('user_id', '=', $user_id)->first();
    if ( $vote )
    {
      return (int) $vote->score;
    }
  }

}
