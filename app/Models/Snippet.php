<?php

namespace App\Models;

use Database\Factories\SnippetFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

#[Fillable(['title', 'description', 'body', 'user_id'])]
class Snippet extends Model
{
    /** @use HasFactory<SnippetFactory> */
    use HasFactory;

    protected $appends = ['score'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function getScoreAttribute(): int
    {
        return (int) $this->votes()->sum('score');
    }

    public function hasUserVoted(int $userId): ?int
    {
        $vote = $this->votes()->where('user_id', $userId)->first();

        return $vote ? (int) $vote->score : null;
    }

    public function tagnames(): array
    {
        return $this->tags()->pluck('name')->all();
    }
}
