<?php

class AuthorizationController extends \BaseController {

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
    $code = Request::get('code');

    $github = OAuth::consumer('GitHub');

    if ( ! empty($code))
    {
      $token = $github->requestAccessToken($code);
      $result = json_decode($github->request('user'), true);

      if ( empty($result['name']) )
      {
        $name = $result['login'];
      }
      else
      {
        $name = $result['name'];
      }

      $email = last(json_decode($github->request('user/emails'), true));

      $userData = [
        'github_id' => $result['id'],
        'github_url' => $result['html_url'],
        'avatar_url' => $result['avatar_url'],
        'email' => $email,
        'name' => $name
        ];

      $user = User::whereGithubId($result['id'])->first();
      if ( ! $user )
      {
        $user = User::create($userData);
      }
      else
      {
        $user->fill($userData);
        $user->save();
      }

      Auth::login($user);
      return Redirect::intended();
    }

    return Redirect::to((string) OAuth::consumer('GitHub')->getAuthorizationUri());
  }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	 */
	public function destroy()
	{
    Auth::logout();
    return Redirect::home();
	}


}
