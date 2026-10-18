<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

#[Fillable(['name', 'slug'])]
class Tag extends Model
{
    public $timestamps = false;

    public function snippets(): MorphToMany
    {
        return $this->morphedByMany(Snippet::class, 'taggable');
    }

    public static function topTags(): array
    {
        $topTags = Cache::remember('topTags', 300, fn () => array_map(
            fn ($tag) => (array) $tag,
            DB::select('
                SELECT tags.name, tag_id, count(tag_id) count, tags.slug FROM taggables
                JOIN tags ON taggables.tag_id = tags.id
                GROUP BY tag_id, tags.name, tags.slug ORDER BY count DESC LIMIT 14'
            )
        ));

        return array_map(fn ($tag) => (object) [
            'id' => $tag['tag_id'],
            'name' => $tag['name'],
            'slug' => $tag['slug'],
        ], $topTags);
    }

    /**
     * Sync a snippet's tags from a comma-separated string.
     */
    public static function updateTags(Snippet $snippet, ?string $tagNamesString): void
    {
        $tagIds = collect(explode(',', (string) $tagNamesString))
            ->map(fn ($name) => trim($name))
            ->filter()
            ->map(fn ($name) => static::firstOrCreate(
                ['name' => $name],
                ['slug' => str($name)->slug()->toString()]
            )->id);

        $snippet->tags()->sync($tagIds);
    }
}
