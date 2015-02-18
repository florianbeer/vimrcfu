<?php namespace Vimrcfu\Tags;

use DB;
use Str;
use Cache;

class EloquentTagsRepository implements TagsRepository {

  /**
   * @var string $name
   * @return mixed
   */
  public function searchByName($name)
  {
    return Tag::where('name', 'LIKE', '%'.$name.'%')->get();
  }

  public function getByName($name)
  {
    return Tag::whereName($name)->first();
  }

  /**
   * @var Vimrcfu\Snippets\Snippet $snippet
   * @var Vimrcfu\Tags\Tag $tags
   */
  public function updateTags($snippet, $tagNamesString)
  {
    $tagNamesArray = explode(',', $tagNamesString);
    $snippetTagNamesArray = $snippet->tagnames();

    $tagNamesToRemove = array_diff($snippetTagNamesArray, $tagNamesArray);
    $tagNamesToAdd = array_diff($tagNamesArray, $snippetTagNamesArray);

    foreach($tagNamesToRemove as $tagname)
    {
      $tag = $this->getByName($tagname);
      $snippet->tags()->detach($tag);
    }

    foreach($tagNamesToAdd as $tagname)
    {
      $tagname = trim($tagname);
      if ($tagname) {
        $tag = Tag::firstOrCreate(['name' => $tagname, 'slug' => Str::slug($tagname)]);
        $snippet->tags()->attach($tag->id);
      }
    }
  }

  /**
   * @return array
   */
  public static function topTags()
  {
   $topTags = Cache::remember('topTags', 5, function ()
    {
      $topTagsResult = DB::select(DB::raw('
        SELECT tags.name, tag_id, count(tag_id) count, tags.slug FROM taggables
        JOIN tags ON taggables.tag_id = tags.id
        GROUP BY tag_id ORDER BY count DESC LIMIT 14'
      ));

      return (isset($topTagsResult)) ? $topTagsResult : [];
    });

   $topTags = array_map(function ($tags) {
     return (object) [
       'id'   => $tags->tag_id,
       'name' => $tags->name,
       'slug' => $tags->slug
       ];
   }, $topTags);

    return $topTags;
  }

  /**
   * @param string search
   * @param int $count
   * @return mixed
   */
  public function relatedTags($search, $count = 20)
  {
    return Tag::where('name', 'LIKE', '%' . $search . '%')->take($count)->get();
  }
}
