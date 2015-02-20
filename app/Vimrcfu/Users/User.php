<?php namespace Vimrcfu\Users;

use Eloquent;
use Vimrcfu\Tags\Tag;
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

  use UserTrait, RemindableTrait;

  protected $hidden = array('password', 'remember_token');

  protected $fillable = ['github_id', 'github_url', 'avatar_url', 'email', 'name'];

  public function snippets()
  {
    return $this->hasMany('Vimrcfu\Snippets\Snippet')->orderBy('id', 'DESC');
  }

  public function comments()
  {
    return $this->hasMany('Vimrcfu\Comments\Comment')->orderBy('id', 'DESC');
  }

  public function votes()
  {
    return $this->hasMany('Vimrcfu\Votes\Vote')->where('score', '=', 1)->orderBy('id', 'DESC');
  }

  public function tags()
  {
    $tag_ids = [];
    $snippets = $this->snippets()->with('tags')->get();
    foreach($snippets as $snippet)
    {
      foreach($snippet->tags as $tag)
      {
        $tag_ids[] = $tag->id;
      }
    }
    $tag_ids = array_unique($tag_ids);

    return Tag::find($tag_ids);
  }
}
