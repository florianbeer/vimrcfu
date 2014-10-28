<?php namespace Vimrcfu\Text;

use Michelf\Markdown;

class Text {

  private function stripTags($text)
  {
    return strip_tags($text, '<em><strong><code><blockquote><p><br><kbd>');
  }

  private function createiExternalLinks($text)
  {
    $regex = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,63}([\w\.\/:\=\?\#\!-]*)/"; 
    if(preg_match($regex, $text, $url)) {
      $text = preg_replace($regex, '<a href="'.$url[0].'" target="_blank">'.$url[0].'</a>', $text);
    }
    return $text;
  }

  private function createSnippetLinks($text)
  {
    $regex = "/snippet#([0-9]*)(\/\S*)?/";
    if ( preg_match($regex, $text, $snippet)) { 
      $text = preg_replace($regex, '<a href="/snippet/' . $snippet[1] . '">Snippet #' . $snippet[1] . '</a>', $text);
    }
    return $text;
  }

  private function renderMarkdown($text)
  {
    return Markdown::defaultTransform($text);
  }

  public function render($text)
  {
    $text = $this->renderMarkdown($text);
    $text = $this->stripTags($text);
    $text = $this->createiExternalLinks($text);
    $text = $this->createSnippetLinks($text);
    return $text;
  }

  public function renderInclude($file)
  {

    $text = \File::get(app_path().'/markdown/'.$file.'.md');
    $text = $this->renderMarkdown($text);
    $text = $this->createSnippetLinks($text);
    return $text;
  }

}
