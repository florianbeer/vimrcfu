<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SnippetsController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VotesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PagesController::class, 'home'])->name('home');
Route::get('faq', [PagesController::class, 'faq'])->name('faq');
Route::get('sitemap.xml', [PagesController::class, 'sitemap']);

Route::get('feed', [FeedController::class, 'index']);

Route::get('search', [SearchController::class, 'index'])->name('search');

Route::get('snippet/hot', [SnippetsController::class, 'hot'])->name('snippet.hot');
Route::resource('snippet', SnippetsController::class)->except('destroy');
Route::middleware('auth')->group(function () {
    Route::get('snippet/{snippet}/up', [VotesController::class, 'up'])->name('vote.up');
    Route::get('snippet/{snippet}/down', [VotesController::class, 'down'])->name('vote.down');
});

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('user/{user}', [UsersController::class, 'show'])->name('user.show');
Route::get('user/{user}/upvotes', [UsersController::class, 'upvotes'])->name('user.votes');

Route::resource('comment', CommentsController::class)
    ->only(['store', 'edit', 'update'])
    ->middleware('auth');

Route::get('tag/search/{name}', [TagsController::class, 'search']);
Route::get('tag/prefetch', [TagsController::class, 'prefetch']);
Route::get('tag/{slug}', [TagsController::class, 'show'])->name('tag.show');

Route::get('snake', fn () => response()->view('errors.503', ['title' => 'Snake'], 503));
