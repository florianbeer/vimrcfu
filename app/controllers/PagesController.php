<?php

class PagesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
    $snippets = Snippet::orderBy('id', 'DESC')->take(4)->get();
    $snippets_count = Snippet::all()->count();
    $comments_count = Comment::all()->count();
    $users_count = User::all()->count();
    $top_snippet = DB::select(DB::raw('SELECT snippets.id, sum(votes.score) points FROM snippets JOIN votes ON snippets.id = votes.snippet_id GROUP BY snippets.id ORDER BY votes.score DESC LIMIT 1'))[0];
    $top_comments = DB::select(DB::raw('SELECT snippets.id, count(comments.id) comments_count FROM snippets JOIN comments ON snippets.id = comments.snippet_id GROUP BY snippet_id ORDER BY comments_count DESC LIMIT 1'))[0];

    return View::make('pages.home')
      ->withSnippets($snippets)
      ->withSnippetsCount($snippets_count)
      ->withCommentsCount($comments_count)
      ->withUsersCount($users_count)
      ->withTopSnippet($top_snippet)
      ->withTopComments($top_comments);

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
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
