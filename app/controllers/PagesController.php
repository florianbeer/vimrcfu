<?php

use Vimrcfu\Tags\Tag;
use Vimrcfu\Users\User;
use Vimrcfu\Comments\Comment;
use Vimrcfu\Snippets\Snippet;
use Vimrcfu\Tags\TagsRepository;
use Vimrcfu\Snippets\SnippetsRepository;

class PagesController extends \BaseController {

  /**
   * @var Vimrc\Snippets\SnippetsRepository
   */
  private $repository;

  /**
   * @var Vimrcfu\Tags\TagRepository
   */
  private $tagsRepository;

  /**
   * @param Vimrcfu\Snippets\SnippetsRepository $respository
   * @param Vimrcfu\Tags\TagsRepository $tagsRespository
   */
  public function __construct(SnippetsRepository $repository, TagsRepository $tagsRepository)
  {
    $this->repository = $repository;
    $this->tagsRepository = $tagsRepository;
  }

  /**
   * Displays the home page.
   *
   * @return Response
   */
  public function home()
  {
    $newSnippets = $this->repository->newSnippets();
    $topSnippet = $this->repository->topSnippet();
    $topCommented = $this->repository->topCommented();
    $topTags = $this->tagsRepository->topTags();
    $title = 'Popular Tags';

    return View::make('pages.home')
      ->withSnippets($newSnippets)
      ->withSnippetsCount(Snippet::remember(5)->get()->count())
      ->withCommentsCount(Comment::remember(5)->get()->count())
      ->withUsersCount(User::remember(5)->get()->count())
      ->withTopSnippet($topSnippet)
      ->withTopComments($topCommented)
      ->withTags($topTags)
      ->withTitle($title);

  }

  /**
   * Displays Frequently Asked Questions.
   *
   * @return void
   */
  public function faq()
  {
    return View::make('pages.markdown')
      ->withTitle('Frequently Asked Questions')
      ->withFile('faq');
  }

  /**
   * Displays the XML sitemap.
   *
   * @return void
   */
  public function sitemap()
  {
    $static = [
      'faq',
      'search',
      'snippet'
    ];

    return View::make('pages.sitemap')
      ->with('static', $static)
      ->with('snippets', Snippet::all())
      ->with('tags', Tag::all())
      ->with('users', User::all());
  }

}
