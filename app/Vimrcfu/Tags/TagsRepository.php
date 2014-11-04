<?php namespace Vimrcfu\Tags;

interface TagsRepository {

  /*
   * Fetches a Tag by its name from storage.
   */
  public function getByName($name);

  /*
   * Updates all Tags for a Snippet.
   */
  public function updateTags($snippet, $tags);

  /*
   * Returns an array of most used Tags.
   */
  public static function topTags();

  /*
   * Returns Tags with a name like $search.
   */
  public function relatedTags($search, $count = 20);

}
