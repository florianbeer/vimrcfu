<?php
Route::get('/', ['as' => 'home', 'uses' => 'PagesController@home']);
Route::get('faq', ['as' => 'faq', 'uses' => 'PagesController@faq']);
Route::get('sitemap.xml', 'PagesController@sitemap');

Route::get('feed', 'FeedController@index');

Route::get('search', ['as' => 'search', 'uses' => 'SearchController@index']);

Route::model('snippet', 'Vimrcfu\Snippets\Snippet');
Route::get('snippet/hot', ['as' => 'snippet.hot', 'uses' => 'SnippetsController@hot']);
Route::resource('snippet', 'SnippetsController', ['except' => 'destroy']);
Route::get('snippet/{id}/up', ['as' => 'vote.up', 'uses' => 'VotesController@up']);
Route::get('snippet/{id}/down', ['as' => 'vote.down', 'uses' => 'VotesController@down']);

Route::model('user', 'Vimrcfu\Users\User');
Route::get('login', ['as' => 'login', 'uses' => 'UsersController@login']);
Route::get('logout', ['as' => 'logout', 'uses' => 'UsersController@logout']);
Route::resource('user', 'UsersController', ['only' => 'show']);
Route::get('user/{user}/upvotes', ['as' => 'user.votes', 'uses' => 'UsersController@upvotes']);

Route::model('comment', 'Vimrcfu\Comments\Comment');
Route::resource('comment', 'CommentsController', ['only' => ['store', 'edit', 'update']]);

Route::get('tag/search/{name}', ['uses' => 'TagsController@search']);
Route::get('tag/prefetch', ['uses' => 'TagsController@prefetch']);
Route::get('tag/{slug}', ['as' => 'tag.show', 'uses' => 'TagsController@show']);

Route::get('snake', function () {
    return Response::view('errors.503', ['title' => 'Snake'], 503);
});
