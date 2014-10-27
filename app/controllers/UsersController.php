<?php

class UsersController extends \BaseController {

	/**
	 * Display the specified resource.
	 *
	 * @param  User $user
	 * @return Response
	 */
	public function show($user)
  {
    $snippets = $user->snippets()->paginate(10);
    return View::make('users.show')
      ->withUser($user)
      ->withSnippets($snippets);
	}

}
