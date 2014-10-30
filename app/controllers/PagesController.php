<?php

class PagesController extends \BaseController {

  /**
   * Display the home page
   *
   * @return Response
   */
  public function home()
  {
    $newSnippets = Snippet::with('comments', 'user')->orderBy('id', 'DESC')->take(5)->get();

    $topSnippet = Cache::remember('topSnippet', 5, function ()
    {
      $topSnippetResult = DB::select(DB::raw('
        SELECT snippets.id, sum(votes.score) points FROM snippets
        JOIN votes ON snippets.id = votes.snippet_id
        GROUP BY snippets.id ORDER BY points DESC, snippets.id DESC LIMIT 1'
      ));

      return (isset($topSnippetResult[0])) ? $topSnippetResult[0] : new Snippet();
    });

    $topComment = Cache::remember('topComment', 5, function ()
    {
      $topCommentResult = DB::select(DB::raw('
        SELECT snippets.id, count(comments.id) comments_count FROM snippets
        JOIN comments ON snippets.id = comments.snippet_id
        GROUP BY snippet_id ORDER BY comments_count DESC LIMIT 1'
      ));

      return (isset($topCommentResult[0])) ? $topCommentResult[0] : new Comment();
    });

    return View::make('pages.home')
      ->withSnippets($newSnippets)
      ->withSnippetsCount(Snippet::remember(5)->get()->count())
      ->withCommentsCount(Comment::remember(5)->get()->count())
      ->withUsersCount(User::remember(5)->get()->count())
      ->withTopSnippet($topSnippet)
      ->withTopComments($topComment);

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
      ->with('users', User::all());
  }

}
