<?php namespace Vimrcfu\Snippets;

use DB;
use Auth;
use Cache;
use Vimrcfu\Votes\Vote;
use Vimrcfu\Tags\TagsRepository;
use Vimrcfu\Validation\SnippetValidator;

class EloquentSnippetsRepository implements SnippetsRepository {

  /**
   * @var Vimrcfu\Validation\SnippetValidator
   */
  protected $validator;

  /**
   * @var Vimrcfu\Tags\TagsRepository
   */
  protected $tagsRepository;

  /**
   * @param Vimrcfu\Validation\SnippetValidator $validator
   * @param Vimrcfu\Tags\TagsRepository $tagsRepository
   */
  public function __construct(SnippetValidator $validator, TagsRepository $tagsRepository)
  {
    $this->validator = $validator;
    $this->tagsRepository = $tagsRepository;
  }

  /**
   * @var string
   * @return mixed
   */
  public function snippetsWithCommentsAndUsersPaginated($order = null)
  {
    switch ($order)
    {
      case 'hot':
        return Snippet::rightJoin('votes', 'votes.snippet_id', '=', 'snippets.id')
          ->orderBy(DB::raw('sum(score)'), 'DESC')
          ->orderBy('snippets.created_at', 'DESC')
          ->groupBy('snippets.id')
          ->havingRaw('sum(score) > 1')
          ->with('comments', 'user')
          ->paginate(10);
      default:
        return  Snippet::with('comments', 'user')->orderBy('id', 'DESC')->paginate(10);
        break;
    }

  }

  /**
   * @return mixed
   */
  public function snippetsForFeed()
  {
    return Snippet::with('user')->orderBy('id', 'desc')->take(20)->get();
  }

  /**
   * @return mixed
   */
  public function newSnippets()
  {
    return Snippet::with('comments', 'user')->orderBy('id', 'DESC')->take(5)->get();
  }

  /**
   * @return mixed
   */
  public function topSnippet()
  {
    return Cache::remember('topSnippet', 5, function ()
    {
      $topSnippetResult = DB::select(DB::raw('
        SELECT snippets.id, sum(votes.score) points FROM snippets
        JOIN votes ON snippets.id = votes.snippet_id
        GROUP BY snippets.id ORDER BY points DESC, snippets.id DESC LIMIT 1'
      ));

      return (isset($topSnippetResult[0])) ? $topSnippetResult[0] : new Snippet();
    });
  }

  /**
   * @return mixed
   */
  public function topCommented()
  {
    return Cache::remember('topComment', 5, function ()
    {
      $topCommentResult = DB::select(DB::raw('
        SELECT snippets.id, count(comments.id) comments_count FROM snippets
        JOIN comments ON snippets.id = comments.snippet_id
        GROUP BY snippet_id ORDER BY comments_count DESC LIMIT 1'
      ));

      return (isset($topCommentResult[0])) ? $topCommentResult[0] : new Comment();
    });
  }

  /**
   * @param array $input
   * @return mixed
   */
  public function create($input)
  {
    $this->validator->validate($input);
    $snippet = new Snippet();
    $snippet->title = $input['title'];
    $snippet->body = $input['body'];
    $snippet->description = $input['description'];
    $snippet->user_id = Auth::user()->id;
    $snippet->save();

    $this->tagsRepository->updateTags($snippet, $input['tags']);

    $vote = new Vote();
    $vote->user_id = Auth::user()->id;
    $vote->snippet_id = $snippet->id;
    $vote->score = 1;
    $vote->save();

    return $snippet;
  }

  /**
   * @param Vimrcfu\Snippets\Snippet $snippet
   * @param array $input
   * @return mixed
   */
  public function update(Snippet $snippet, $input)
  {
    $this->validator->validate($input);

    $snippet->title       = $input['title'];
    $snippet->body        = $input['body'];
    $snippet->description = $input['description'];
    $snippet->save();

    $this->tagsRepository->updateTags($snippet, $input['tags']);

    return $snippet;
  }

  /**
   * @param string $search
   * @return array
   */
  public function fulltextSearch($search) {
    // Need to use simplePaginate() here and then run
    // an extra count() query because Laravel 2.4's Paginator class
    // cannot determine the correct total number automatically in this case.
    $items = Snippet::whereRaw('MATCH(title,description,body) AGAINST(? IN BOOLEAN MODE)')
      ->select('*')
      ->addSelect( DB::raw('MATCH (title) AGAINST(?) title_relevance') )
      ->addSelect( DB::raw('MATCH (title,description,body) AGAINST (?) relevance') )
      ->setBindings([$search,$search,$search])
      ->orderBy('title_relevance', 'desc')
      ->orderBy('relevance', 'desc')
      ->with('comments', 'user')
      ->simplePaginate(10);

    $total = Snippet::whereRaw('MATCH(title,description,body) AGAINST(? IN BOOLEAN MODE)', [$search])->count();

    return [
      'items' => $items,
      'total' => $total
      ];
  }

}
