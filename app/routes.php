<?php
Route::get('/', ['as' => 'home', 'uses' => 'PagesController@home']);
Route::get('search', ['as' => 'search', 'uses' => 'SearchController@index']);
Route::get('login', ['as' => 'login', 'uses' => 'AuthorizationController@create']);
Route::get('logout', ['as' => 'logout', 'uses' => 'AuthorizationController@destroy']);
Route::get('faq', ['as' => 'faq', 'uses' => 'PagesController@faq']);
Route::get('sitemap.xml', 'PagesController@sitemap');
Route::get('feed', 'FeedController@index');

Route::model('snippet', 'Vimrcfu\Snippets\Snippet');
Route::resource('snippet', 'SnippetsController', ['except' => 'destroy']);
Route::get('snippet/{id}/up', ['as' => 'vote.up', 'uses' => 'VotesController@up']);
Route::get('snippet/{id}/down', ['as' => 'vote.down', 'uses' => 'VotesController@down']);

Route::model('user', 'User');
Route::resource('user', 'UsersController', ['only' => 'show']);

Route::model('comment', 'Comment');
Route::resource('comment', 'CommentsController', ['only' => ['store', 'edit', 'update']]);

Route::get('tag/search/{name}', ['uses' => 'TagsController@search']);
Route::get('tag/prefetch', ['uses' => 'TagsController@prefetch']);
Route::get('tag/{slug}', ['as' => 'tag.show', 'uses' => 'TagsController@show']);

Route::get('snake', function () {
    return Response::view('errors.503', ['title' => 'Snake'], 503);
});
