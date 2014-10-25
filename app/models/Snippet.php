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
    return $this->hasMany('Comment')
      ->orderBy('id', 'DESC');
  }

}
