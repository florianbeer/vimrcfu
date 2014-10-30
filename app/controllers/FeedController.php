<?php

class FeedController extends \BaseController {

  /**
   * Display the RSS feed
   *
   * @return Response
   */
  public function index()
  {
    $snippets = Snippet::with('user')->orderBy('id', 'DESC')->take(20)->get();
    $content = View::make('pages.feed', compact('snippets'));

    return Response::make($content, '200')
      ->header('Content-Type', 'application/rss+xml');
  }


}
