<?php

use Vimrcfu\Snippets\SnippetsRepository;

class FeedController extends \BaseController {

  /**
   * @var Vimrcfu\Snippets\SnippetsRepository
   */
  private $snippetsRepository;

  /**
   * @param Vimrcfu\Snippets\SnippetsRepository $snippetsRepository
   */
  public function __construct(SnippetsRepository $snippetsRepository)
  {
    $this->snippetsRepository = $snippetsRepository;
  }

  /**
   * Shows RSS feed for the last 20 Snippets.
   *
   * @return mixed
   */
  public function index()
  {
    $snippets = $this->snippetsRepository->snippetsForFeed();
    $content = View::make('pages.feed', compact('snippets'));

    return Response::make($content, '200')
      ->header('Content-Type', 'application/rss+xml');
  }

}
