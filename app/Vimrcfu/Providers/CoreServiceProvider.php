<?php namespace Vimrcfu\Providers;

use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider {

  public function register()
  {
    $this->app->bind('text', 'Vimrcfu\Core\Text');
  }

}
