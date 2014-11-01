<?php

class SnippetsController extends \BaseController {

  public function __construct()
  {
    $this->beforeFilter('auth', ['only' => ['create', 'store', 'edit', 'update']]);
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $snippets = Snippet::with('comments', 'user')->orderBy('id', 'DESC')->paginate(10);

    return View::make('snippets.index', compact('snippets'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return View::make('snippets.create')
      ->withSnippet(new Snippet());
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
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
   * Display the specified resource.
   *
   * @param  Snippet  $snippet
   * @return Response
   */
  public function show(Snippet $snippet)
  {
    $comments = $snippet->load('comments');

    return View::make('snippets.show', ['snippet' => $snippet, 'comments' => $comments]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  Snippet $snippet
   * @return Response
   */
  public function edit(Snippet $snippet)
  {
    if ( Auth::user()->id != $snippet->user_id )
    {
      return Redirect::home();
    }

    return View::make('snippets.edit')
      ->withSnippet($snippet);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  Snippet $snippet
   * @return Response
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
