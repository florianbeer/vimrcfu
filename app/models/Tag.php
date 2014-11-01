<?php

class Tag extends Eloquent {
  public $timestamps = false;
  protected $fillable = ['name', 'slug'];

  public static function findOrCreate($name)
  {
    $obj = static::where('name', $name)->first();

    return $obj ?: new static();
  }

  public function snippets()
  {
    return $this->morphedByMany('Snippet', 'taggable');
  }

}
