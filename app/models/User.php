<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

  protected $fillable = ['github_id', 'github_url', 'avatar_url', 'email', 'name'];

  public function snippets()
  {
    return $this->hasMany('Snippet')
      ->orderBy('id', 'DESC');
  }

  public function comments()
  {
    return $this->hasMany('Comment')
      ->orderBy('id', 'DESC');
  }

  public function votes()
  {
    return $this->hasMany('Votes');
  }

}
