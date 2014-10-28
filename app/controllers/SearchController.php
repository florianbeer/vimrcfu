<?php

class SearchController extends \BaseController {

  /**
   * Search snippets
   *
   * @return Response
   */
  public function index()
  {
    $search = Input::get('q');
    if ( ! empty($search))
    {
      $snippets = Snippet::whereRaw('MATCH(title,description,body) AGAINST(? IN BOOLEAN MODE)', [$search])
        ->paginate(10);

      return View::make('search.index', compact('snippets'));
    }

    return Redirect::route('snippet.index');
  }

}
