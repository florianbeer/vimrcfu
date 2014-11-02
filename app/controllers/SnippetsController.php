<?php

class SnippetsController extends \BaseController {

  public function __construct()
  {
    $this->beforeFilter('auth', ['only' => ['create', 'store', 'edit', 'update']]);
  }

  /**
   * Displays all Snippets paginated.
   *
   * @return View
   */
  public function index()
  {
    $snippets = Snippet::with('comments', 'user')->orderBy('id', 'DESC')->paginate(10);

    return View::make('snippets.index', compact('snippets'));
  }

  /**
   * Shows the form for creating a new Snippet.
   *
   * @return View
   */
  public function create()
  {
    return View::make('snippets.create')->withSnippet(new Snippet());
  }

  /**
   * Validates form input and stores a new Snippet.
   *
   * @return Redirect
   */
  public function store()
  {
    $validation = Validator::make(Input::all(), Snippet::$rules);

    if ( $validation->fails() )
    {
      return Redirect::route('snippet.create')
        ->withErrors($validation)
        ->withInput();
    }

    $snippet = new Snippet();
    $snippet->title = Input::get('title');
    $snippet->body = Input::get('body');
    $snippet->description = Input::get('description');
    $snippet->user_id = Auth::user()->id;
    $snippet->save();

    $snippet->updateTags(explode(',', Input::get('tags')));

    $vote = new Vote();
    $vote->user_id = Auth::user()->id;
    $vote->snippet_id = $snippet->id;
    $vote->score = 1;
    $vote->save();

    return Redirect::route('snippet.show', $snippet->id);
  }

  /**
   * Displays a Snippet.
   *
   * @param  Snippet  $snippet
   * @return View
   */
  public function show(Snippet $snippet)
  {
    $comments = $snippet->load('comments');

    return View::make('snippets.show', compact('snippet', 'comments'));
  }

  /**
   * Shows the form for editing a Snippet.
   *
   * @param  Snippet $snippet
   * @return Redirect|View
   */
  public function edit(Snippet $snippet)
  {
    if ( Auth::user()->id != $snippet->user_id )
    {
      return Redirect::home();
    }

    return View::make('snippets.edit', compact('snippet'));
  }

  /**
   * Updates a Snippet in storage.
   *
   * @param  Snippet $snippet
   * @return Redirect
   */
  public function update(Snippet $snippet)
  {
    if ( Auth::user()->id != $snippet->user_id )
    {
      return Redirect::home();
    }

    $validation = Validator::make(Input::all(), Snippet::$rules);

    if ( $validation->fails() )
    {
      return Redirect::route('snippet.edit')
        ->withErrors($validation)
        ->withInput();
    }

    $snippet->title = Input::get('title');
    $snippet->body = Input::get('body');
    $snippet->description = Input::get('description');
    $snippet->save();

    $snippet->updateTags(explode(',', Input::get('tags')));

    return Redirect::route('snippet.show', $snippet->id);

  }

}
