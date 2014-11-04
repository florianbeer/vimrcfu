<?php

use Vimrcfu\Snippets\Snippet;
use Vimrcfu\Snippets\SnippetsRepository;

class SnippetsController extends \BaseController {

  /**
   * @var Vimrc\Snippets\SnippetsRepository
   */
  private $repository;

  /**
   * @param Vimrcfu\Snippets\SnippetsRepository $repository
   */
  public function __construct(SnippetsRepository $repository)
  {
    $this->beforeFilter('auth', ['only' => ['create', 'store', 'edit', 'update']]);
    $this->repository = $repository;
  }

  /**
   * Displays all Snippets paginated.
   *
   * @return mixed
   */
  public function index()
  {
    $snippets = $this->repository->snippetsWithCommentsAndUsersPaginated();

    return View::make('snippets.index', compact('snippets'));
  }

  /**
   * Shows the form for creating a new Snippet.
   *
   * @return mixed
   */
  public function create()
  {
    return View::make('snippets.create')->withSnippet(new Snippet());
  }

  /**
   * Stores a new Snippet.
   *
   * @return mixed
   */
  public function store()
  {
    $snippet = $this->repository->create(Input::all());

    return Redirect::route('snippet.show', $snippet->id);
  }

  /**
   * Displays a Snippet.
   *
   * @param Vimrcfu\Snippets\Snippet $snippet
   * @return mixed
   */
  public function show(Snippet $snippet)
  {
    return View::make('snippets.show', compact('snippet'));
  }

  /**
   * Shows the form for editing a Snippet.
   *
   * @param  Vimrcfu\Snippets\Snippet $snippet
   * @return mixed
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
   * @param  Vimrcfu\Snippets\Snippet $snippet
   * @return mixed
   */
  public function update(Snippet $snippet)
  {
    if ( Auth::user()->id != $snippet->user_id )
    {
      return Redirect::home();
    }

    $this->repository->update($snippet, Input::all());

    return Redirect::route('snippet.show', $snippet->id);

  }

}
