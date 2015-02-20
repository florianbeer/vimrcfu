<?php

use Vimrcfu\Users\UsersRepository;

class UsersController extends \BaseController {

  /**
   * @var Vimrcfu\Users\UsersRepository
   */
  private $repository;

  /**
   * @param Vimrcfu\Users\UsersRepository $repository
   */
  public function __construct(UsersRepository $repository)
  {
    $this->repository = $repository;
  }

  /**
   * Persist new User with GitHub data then log in.
   *
   * @return mixed
   */
  public function login()
  {
    $code = Request::get('code');
    $github = OAuth::consumer('GitHub');

    if ( ! empty($code))
    {
      $token = $github->requestAccessToken($code);
      $result = json_decode($github->request('user'), true);

      if ( empty($result['name']) )
      {
        $result['name'] = $result['login'];
      }

      $result['email'] = last(json_decode($github->request('user/emails'), true));

      $githubData = [
        'github_id' => $result['id'],
        'github_url' => $result['html_url'],
        'avatar_url' => $result['avatar_url'],
        'email' => $result['email'],
        'name' => $result['name']
        ];

      Auth::login($this->repository->findOrCreate($githubData));

      return Redirect::intended();
    }

    return Redirect::to((string) OAuth::consumer('GitHub')->getAuthorizationUri());
  }

  /**
   * Log out User.
   *
   * @return mixed
   */
  public function logout()
  {
    Auth::logout();

    return Redirect::home();
  }

  /**
   * Shows a User with all Tags and paginated Snippets.
   *
   * @param Vimrcfu\Users\User $user
   * @return mixed
   */
  public function show($user)
  {
    $snippetsResult = $user->snippets();
    $total          = $snippetsResult->count();
    $snippets       = $snippetsResult->with('comments')->simplePaginate(10);
    $tags           = $user->tags();

    return View::make('users.show', compact('user', 'snippets', 'total', 'tags'));
  }

  /**
   * Shows a User's upvoted Snippets
   *
   * @param Vimrcfu\Users\User $user
   * @return mixed
   */
  public function upvotes($user)
  {
    $snippetsResult = Vimrcfu\Snippets\Snippet::select('snippets.*')
      ->where('user_id', '!=', $user->id)
      ->whereHas('votes', function ($q) use ($user) {
        $q->where('user_id', $user->id)
          ->where('score', '=', '1');
      })->orderBy('created_at', 'DESC');
    $total          = $snippetsResult->count();
    $snippets       = $snippetsResult->simplePaginate(10);
    $tags           = $user->tags();

    return View::make('users.show', compact('user', 'snippets', 'total', 'tags'));
  }
}
