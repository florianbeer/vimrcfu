<?php

use Vimrcfu\Snippets\Snippet;
use Vimrcfu\Snippets\SnippetsRepository;

class PagesController extends \BaseController {

  /*
   * @var \Vimrc\Snippets\SnippetsRepository
   */
  private $repository;

  /*
   * @param Vimrcfu\Snippets\SnippetsRepository $respository
   */
  public function __construct(SnippetsRepository $repository)
  {
    $this->repository = $repository;
  }

  /**
   * Display the home page
   *
   * @return Response
   */
  public function home()
  {
    $newSnippets = $this->repository->newSnippets();

    $topSnippet = $this->repository->topSnippet();

    $topComment = Cache::remember('topComment', 5, function ()
    {
      $topCommentResult = DB::select(DB::raw('
        SELECT snippets.id, count(comments.id) comments_count FROM snippets
        JOIN comments ON snippets.id = comments.snippet_id
        GROUP BY snippet_id ORDER BY comments_count DESC LIMIT 1'
      ));

      return (isset($topCommentResult[0])) ? $topCommentResult[0] : new Comment();
    });

    $topTags = Tag::topTags();

    return View::make('pages.home')
      ->withSnippets($newSnippets)
      ->withSnippetsCount(Snippet::remember(5)->get()->count())
      ->withCommentsCount(Comment::remember(5)->get()->count())
      ->withUsersCount(User::remember(5)->get()->count())
      ->withTopSnippet($topSnippet)
      ->withTopComments($topComment)
      ->withTags($topTags);

  }

  /**
   * Display Frequently Asked Questions
   *
   * @return void
   * @author Florian Beer
   */
  public function faq()
  {
    return View::make('pages.markdown')
      ->withTitle('Frequently Asked Questions')
      ->withFile('faq');
  }

  /**
   * Construct an XML sitemap
   *
   * @return void
   * @author Florian Beer
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
