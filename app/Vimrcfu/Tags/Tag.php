<?php namespace Vimrcfu\Tags;

use Eloquent;

class Tag extends Eloquent {
  public $timestamps = false;
  protected $fillable = ['name', 'slug'];

  public function snippets()
  {
    return $this->morphedByMany('Vimrcfu\Snippets\Snippet', 'taggable');
  }

}
