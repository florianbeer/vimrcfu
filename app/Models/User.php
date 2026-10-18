<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Collection;

#[Fillable(['github_id', 'github_url', 'avatar_url', 'email', 'name'])]
#[Hidden(['remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory;

    public function snippets(): HasMany
    {
        return $this->hasMany(Snippet::class)->orderByDesc('id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->orderByDesc('id');
    }

    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class)->where('score', 1)->orderByDesc('id');
    }

    public function tags(): Collection
    {
        $tagIds = $this->snippets()->with('tags')->get()
            ->flatMap(fn (Snippet $snippet) => $snippet->tags->pluck('id'))
            ->unique();

        return Tag::findMany($tagIds);
    }
}
