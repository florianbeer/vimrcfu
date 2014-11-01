<?php namespace Vimrcfu\Search;

class Search {

  public function fulltext($search)
  {

      // Need to use simplePaginate() here and then run
      // an extra count() query because Laravel 2.4's Paginator
      // class cannot determine the correct total number in this case.
      $items = \Snippet::whereRaw('MATCH(title,description,body) AGAINST(? IN BOOLEAN MODE)')
        ->select('*')
        ->addSelect( \DB::raw('MATCH (title) AGAINST(?) title_relevance') )
        ->addSelect( \DB::raw('MATCH (title,description,body) AGAINST (?) relevance') )
        ->setBindings([$search,$search,$search])
        ->orderBy('title_relevance', 'desc')
        ->orderBy('relevance', 'desc')
        ->with('comments', 'user')
        ->simplePaginate(10);

      $total = \Snippet::whereRaw('MATCH(title,description,body) AGAINST(? IN BOOLEAN MODE)', [$search])->count();

      return [
        'items' => $items,
        'total' => $total
        ];
  }

  public function relatedTags($search, $count = 20)
  {
    $tags = \Tag::where('name', 'LIKE', '%' . $search . '%')->take($count)->get();

    return $tags;
  }

}
