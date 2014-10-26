<?php

class Snippet extends Eloquent {
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

  public function getScore($id)
  {
    return $this->votes()->where('snippet_id', '=', $id)->sum('score');
  }

}
