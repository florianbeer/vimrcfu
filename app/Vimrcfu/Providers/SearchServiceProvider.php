<?php namespace Vimrcfu\Providers;

use Illuminate\Support\ServiceProvider;

class SearchServiceProvider extends ServiceProvider {

  public function register()
  {
    $this->app->bind('search', 'Vimrcfu\Search\Search');
  }

}
