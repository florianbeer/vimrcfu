<?php

class SnippetsController extends \BaseController {

  public function __construct()
  {
    $this->beforeFilter('auth', ['only' => ['create', 'update', 'delete']]);
  }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
    $snippets = Snippet::paginate(10);
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
      ->withSnippet(new Snippet);
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

    $snippet = Snippet::create([
      'title' => Input::get('title'),
      'body' => Input::get('body'),
      'description' => Input::get('description'),
      'user_id' => Auth::user()->id
      ]);

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
    $user = $snippet->user;
    return View::make('snippets.show', ['snippet' => $snippet, 'user' => $user]);
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

    return View::make('snippets.edit', ['snippet' => $snippet]);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Snippet $snippet
	 * @return Response
	 */
	public function update(Snippet $snippet)
	{
    $validation = Validator::make(Input::all(), Snippet::$rules);

    if( $validation->fails() )
    {
      return Redirect::route('snippet.edit')
        ->withErrors($validation)
        ->withInput();
    }

    $snippet->title = Input::get('title');
    $snippet->body = Input::get('body');
    $snippet->description = Input::get('description');
    $snippet->save();
  
    return Redirect::route('snippet.show', $snippet->id);

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
