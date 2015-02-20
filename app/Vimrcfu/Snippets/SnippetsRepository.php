<?php namespace Vimrcfu\Snippets;

interface SnippetsRepository {

  /*
   * Retrieves Snippets and their Comments from
   * storage and outputs them paginated.
   */
  public function snippetsWithCommentsAndUsersPaginated($order);

  /*
   * Returns the newest Snippets.
   */
  public function newSnippets();

  /*
   * Fetches the most commented on Snippet from storage.
   */
  public function topCommented();

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

  /*
   * Initiates a fulltext search over Snippet
   * title, description and body. With additional
   * weight for the title field. Returns an
   * array with items and total number of results.
   */
  public function fulltextSearch($search);

}
