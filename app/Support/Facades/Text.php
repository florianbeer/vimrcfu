<?php

namespace App\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string render(string $text)
 * @method static string renderInclude(string $filename)
 * @method static string renderForRss(string $text)
 * @method static string xmlentities(string $text)
 *
 * @see \App\Services\Text
 */
class Text extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \App\Services\Text::class;
    }
}
