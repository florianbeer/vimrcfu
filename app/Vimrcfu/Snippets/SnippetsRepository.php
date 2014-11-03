<?php namespace Vimrcfu\Snippets;

interface SnippetsRepository {

  /*
   * Retrieves Snippets and their Comments from
   * storage and outputs them paginated.
   */
  public function snippetsWithCommentsPaginated();

  /*
   * Returns the newest Snippets
   */
  public function newSnippets();

  /*
   * Validates and creates a new Snippet in storage,
   * updates all Tags and sets an upvote by the creating user.
   */
  public function create($input);

  /*
   * Validates and updates a Snippet in storage,
   * updates all Tags.
   */
  public function update(Snippet $snippet, $input);

}
