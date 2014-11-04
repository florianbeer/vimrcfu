<?php namespace Vimrcfu\Snippets;

use Eloquent;

class Snippet extends Eloquent {
  protected $fillable = ['title', 'description', 'body', 'user_id'];
  protected $appends = array('score');

  public function user()
  {
    return $this->belongsTo('Vimrcfu\Users\User');
  }

  public function comments()
  {
    return $this->hasMany('Vimrcfu\Comments\Comment');
  }

  public function votes()
  {
    return $this->hasMany('Vimrcfu\Votes\Vote');
  }

  public function tags()
  {
    return $this->morphToMany('Vimrcfu\Tags\Tag', 'taggable');
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

  public function hasTag($tag)
  {
    return $this->tags->contains($tag->id);
  }

  public function tagnames()
  {
    $tagnames = [];
    $tags = $this->tags()->get(array('name'));

    foreach ($tags as $tag) {
      $tagnames[] = $tag->name;
    }

    return $tagnames;
  }

}
