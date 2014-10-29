<?php namespace Vimrcfu\Text;

use Michelf\Markdown;

class Text {

  /**
   * Remova unwanted HTML tags
   *
   * @param string $text
   * @return string
   * @author Florian Beer
   */
  private function stripTags($text)
  {
    return strip_tags($text, '<em><strong><code><blockquote><p><br><kbd>');
  }

  /**
   * Creates clickable links from URLs
   *
   * @param string $text
   * @return string
   * @author Florian Beer
   */
  private function createiExternalLinks($text)
  {
    $regex = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,63}([\w\.\/:\=\?\#\!-]*)/";
    return preg_replace($regex, '<a href="$0" target="_blank">$0</a>', $text);
  }

  /**
   * Constructs clickable internal links to Snippets
   *
   * @param string $text
   * @return string
   * @author Florian Beer
   */
  private function createSnippetLinks($text)
  {
    $regex = "/snippet#([0-9]*)(\/\S*)?/";
    return preg_replace($regex, '<a href="/snippet/$1">Snippet #$1</a>', $text);
  }

  /**
   * Returns HTML from Markdown
   *
   * @param string $text
   * @return string
   * @author Florian Beer
   */
  private function renderMarkdown($text)
  {
    return Markdown::defaultTransform($text);
  }

  /**
   * Returns HTML without unwanted tags
   * with external and internal links
   *
   * @param string $text
   * @return string
   * @author Florian Beer
   */
  public function render($text)
  {
    $text = $this->renderMarkdown($text);
    $text = $this->stripTags($text);
    $text = $this->createiExternalLinks($text);
    $text = $this->createSnippetLinks($text);
    return $text;
  }

  /**
   * Returns HTML with all tags intact
   *
   * @param string $file
   * @return string
   * @author Florian Beer
   */
  public function renderInclude($file)
  {
    $text = \File::get(app_path().'/markdown/'.$file.'.md');
    $text = $this->renderMarkdown($text);
    $text = $this->createSnippetLinks($text);
    return $text;
  }

}
