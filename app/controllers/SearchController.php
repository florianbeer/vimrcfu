<?php

class SearchController extends \BaseController {

  /**
   * Search snippets
   *
   * @return Response
   */
  public function index()
  {
    if ( ! empty(Input::get('q')))
    {
      $snippets = Snippet::whereRaw('MATCH(title,description,body) AGAINST(? IN BOOLEAN MODE)', [Input::get('q')])
        ->paginate(10);

      return View::make('search.index', compact('snippets'));
    }

    return Redirect::route('snippet.index');
  }

}
