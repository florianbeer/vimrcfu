<?php

class Snippet extends Eloquent {
  protected $fillable = ['title', 'body', 'user_id'];

  public function user() {
    return $this->belongsTo('User');
  }

}
