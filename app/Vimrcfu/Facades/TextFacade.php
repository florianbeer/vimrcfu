<?php namespace Vimrcfu\Facades;

use Illuminate\Support\Facades\Facade;

class TextFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
      return 'text';
    }
}
