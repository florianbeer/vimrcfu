<?php
use \User;

class AuthorizationController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


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
      $user = User::whereGithubId($result['id'])->first();
      if ($user)
      {
        Auth::login($user);
      }
      else
      {
        User::create([
          'github_id' => $result['id'],
          'github_url' => $result['url'],
          'email' => $result['email'],
          'name' => $result['name']
          ]);
      }
      return Redirect::home();
    }

    return Redirect::to((string) OAuth::consumer('GitHub')->getAuthorizationUri());
  }


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
