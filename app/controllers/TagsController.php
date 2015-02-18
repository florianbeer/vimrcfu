<?php

use Vimrcfu\Tags\Tag;
use Vimrcfu\Tags\TagsRepository;

class TagsController extends \BaseController {

  /**
   * @var Vimrcfu\Tags\TagsRepository
   */
  private $repository;

  /**
   * @param Vimrcfu\Tags\TagsRepository $repository
   */
  public function __construct(TagsRepository $repository)
  {
    $this->repository = $repository;
  }

  /**
   * Incremental search for Tags,
   * Used in autocomplete input field.
   *
   * @return mixed
   */
  public function search($string)
  {
    return $this->repository->searchByName($string);
  }

  /**
   * Returns top Tags array,
   * Used in prefetch for autocomplete.
   *
   * @return array
   */
  public function prefetch()
  {
    return $this->repository->topTags();
  }

  /**
   * Displays all Snippets for a specific Tag.
   *
   * @param string $slug
   * @return mixed
   */
  public function show($slug)
  {
    $tag = Tag::where('slug', $slug)->first();

    if ( ! $tag)
    {
      App::abort(404);
    }

    $snippets = $tag->snippets()->paginate(10);

    return View::make('snippets.index', compact('snippets'))
      ->with('title', $tag->name);
  }

}
