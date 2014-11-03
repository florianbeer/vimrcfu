<?php namespace Vimrcfu\Snippets;

use DB;
use Auth;
use Vote;
use Cache;
use Vimrcfu\Validation\SnippetValidator;
use Vimrcfu\Exceptions\ValidationException;

class EloquentSnippetsRepository implements SnippetsRepository {

  /*
   * @var Vimrcfu\Validation\SnippetValidator
   */
  protected $validator;

  /*
   * @param Vimrcfu\Validation\SnippetValidator $validator
   */
  public function __construct(SnippetValidator $validator)
  {
    $this->validator = $validator;
  }

  /*
   * @preturn mixed
   */
  public function snippetsWithCommentsPaginated()
  {
    $snippets =  Snippet::with('comments', 'user')
      ->orderBy('id', 'DESC')
      ->paginate(10);

    return $snippets;
  }

  /*
   * @return mixed
   */
  public function newSnippets()
  {
    return Snippet::with('comments', 'user')->orderBy('id', 'DESC')->take(5)->get();
  }

  /*
   * return mixed
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

  /*
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

    $snippet->updateTags(explode(',', $input['tags']));

    $vote = new Vote();
    $vote->user_id = Auth::user()->id;
    $vote->snippet_id = $snippet->id;
    $vote->score = 1;
    $vote->save();

    return $snippet;
  }

  /*
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

    $snippet->updateTags(explode(',', $input['tags']));

    return $snippet;
  }

}
