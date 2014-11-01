<?php

class TagsController extends \BaseController {

  /**
   * Incremental search for Tags
   * Used in autocomplete input field
   *
   * @return Response
   */
  public function search($string)
  {
    return Tag::where('name', 'LIKE', '%'.$string.'%')->get();
  }

  /**
   * Display the specified resource.
   *
   * @param  string  $slug
   * @return Response
   */
  public function show($slug)
  {
    $tag = Tag::where('slug', $slug)->first();
    $snippets = $tag->snippets()->paginate(10);

    return View::make('snippets.index', compact('snippets'))
      ->with('title', $tag->name);
  }

}
