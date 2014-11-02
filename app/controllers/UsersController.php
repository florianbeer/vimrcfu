<?php

class UsersController extends \BaseController {

  /**
   * Displays a User.
   *
   * @param  User $user
   * @return View
   */
  public function show($user)
  {
    $snippetsResult = $user->snippets();
    $total          = $snippetsResult->count();
    $snippets       = $snippetsResult->with('comments')->simplePaginate(10);
    $tags           = $user->tags();

    return View::make('users.show', compact('user', 'snippets', 'total', 'tags'));
  }

}
