<?php namespace Vimrcfu\Providers;

use Illuminate\Support\ServiceProvider;

class PersistenceServiceProvider extends ServiceProvider {

  public function register()
  {
    $this->app->bind('Vimrcfu\Snippets\SnippetsRepository', 'Vimrcfu\Snippets\EloquentSnippetsRepository');
  }

}
