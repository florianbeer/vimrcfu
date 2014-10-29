<?php

class SearchController extends \BaseController {

  /**
   * MySQL fulltext search for snippets
   *
   * @return Response
   */
  public function index()
  {
    $search = Input::get('q');
    if ( ! empty($search))
    {
      $snippets = Snippet::whereRaw('MATCH(title,description,body) AGAINST(? IN BOOLEAN MODE)', [$search])
        ->with('comments', 'user')
        ->paginate(10);

      return View::make('search.index', compact('snippets'));
    }

    return Redirect::route('snippet.index');
  }

}
