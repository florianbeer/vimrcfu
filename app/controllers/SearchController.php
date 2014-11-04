<?php

use Vimrcfu\Tags\TagsRepository;
use Vimrcfu\Snippets\SnippetsRepository;

class SearchController extends \BaseController {

  /**
   * @var Vimrcfu\Snippets\SnippetsRepository
   */
  private $snippetsRepository;

  /**
   * @var Vimrcfu\Tags\TagsRepository
   */
  private $tagsRepository;

  /**
   * @param Vimrcfu\Snippets\SnippetsRepository $snippetsRepository
   * @param Vimrcfu\Tags\TagsRepository $tagsRepository
   */
  public function __construct(SnippetsRepository $snippetsRepository, TagsRepository $tagsRepository)
  {
    $this->snippetsRepository = $snippetsRepository;
    $this->tagsRepository = $tagsRepository;
  }

  /**
   * Shows the search page or redirects to Snippets
   * index page in case no searchterm was entered.
   *
   * @return mixed
   */
  public function index()
  {
    $search = Input::get('q');
    if ( ! empty($search))
    {
      $searchresult = $this->snippetsRepository->fulltextSearch($search);
      $tags = $this->tagsRepository->relatedTags($search);

      return View::make('search.index')
        ->withSnippets($searchresult['items'])
        ->withTotal($searchresult['total'])
        ->withTags($tags);
    }

    return Redirect::route('snippet.index');
  }

}
