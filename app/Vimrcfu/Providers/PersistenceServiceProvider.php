<?php namespace Vimrcfu\Providers;

use Illuminate\Support\ServiceProvider;

class PersistenceServiceProvider extends ServiceProvider {

  public function register()
  {
    $this->app->bind('Vimrcfu\Comments\CommentsRepository', 'Vimrcfu\Comments\EloquentCommentsRepository');
    $this->app->bind('Vimrcfu\Snippets\SnippetsRepository', 'Vimrcfu\Snippets\EloquentSnippetsRepository');
    $this->app->bind('Vimrcfu\Tags\TagsRepository', 'Vimrcfu\Tags\EloquentTagsRepository');
    $this->app->bind('Vimrcfu\Users\UsersRepository', 'Vimrcfu\Users\EloquentUsersRepository');
  }

}
