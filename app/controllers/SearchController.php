<?php

use Vimrcfu\Search\Search;

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

      $Search = new Search();
      $searchresult = $Search->fulltext($search);
      $tags = $Search->relatedTags($search);

      return View::make('search.index')
        ->withSnippets($searchresult['items'])
        ->withTotal($searchresult['total'])
        ->withTags($tags);
    }

    return Redirect::route('snippet.index');
  }

}

