<?php

class Tag extends Eloquent {
  public $timestamps = false;
  protected $fillable = ['name', 'slug'];

  public function snippets()
  {
    return $this->morphedByMany('Snippet', 'taggable');
  }

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

}
