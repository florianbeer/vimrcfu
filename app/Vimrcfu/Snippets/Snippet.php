<?php namespace Vimrcfu\Snippets;

use Tag;
use Str;
use Eloquent;

class Snippet extends Eloquent {
  protected $fillable = ['title', 'description', 'body', 'user_id'];
  protected $appends = array('score');

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

  public function tags()
  {
    return $this->morphToMany('Tag', 'taggable');
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

  public function updateTags($tagnames)
  {

    $tags = $this->tagnames();

    $tagsToRemove = array_diff($tags, $tagnames);
    $tagsToAdd = array_diff($tagnames, $tags);

    foreach($tagsToRemove as $tagname)
    {
      $tag = Tag::where('name', $tagname)->first();
      $this->tags()->detach($tag->id);
    }
    foreach($tagsToAdd as $tagname)
    {
      $tag = Tag::firstOrCreate(['name' => $tagname]);

      if ( empty($tag->name) )
      {
        $tag->fill([
          'name' => $tagname,
          'slug' => Str::slug($tagname)
          ]);
        $tag->save();
      }
      $this->tags()->attach($tag->id);
    }
  }

}
