<?php

use \Michelf\Markdown;

class BaseModel extends Eloquent {

  public function getMarkdownBody($body)
  {
    $body = Markdown::defaultTransform($body);
    $body = strip_tags($body, '<em><strong><code><blockquote><p><br>');
    $URLregex = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
    if(preg_match($URLregex, $body, $url)) {
      $body = preg_replace($URLregex, '<a href="'.$url[0].'" target="_blank">'.$url[0].'</a>', $body);
    } 
    $snippetRegex = "/snippet#([0-9]*)(\/\S*)?/";
    if ( preg_match($snippetRegex, $body, $snippet)) {
      $body = preg_replace($snippetRegex, '<a href="/snippet/' . $snippet[1] . '">Snippet #' . $snippet[1] . '</a>', $body);
    }
    return $body;
  }

}
