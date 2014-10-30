<?php namespace Vimrcfu\Providers;

use Illuminate\Support\ServiceProvider;

class TextServiceProvider extends ServiceProvider {

  public function register()
  {
    $this->app->bind('text', 'Vimrcfu\Text\Text');
  }

}
