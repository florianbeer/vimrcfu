<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Michelf\MarkdownExtra;

class Text
{
    /**
     * Remove unwanted HTML tags.
     */
    private function stripTags(string $text): string
    {
        $regex = "/<(?!\/?(em|strong|code|blockquote|p|br|kbd)(?=>))\/?.*?>/";

        return preg_replace($regex, '', $text);
    }

    /**
     * Creates clickable links from URLs.
     */
    private function createExternalLinks(string $text): string
    {
        $regex = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,63}([\w\.\/:\=\?\#\!-]*)/";

        return preg_replace($regex, '<a href="$0" target="_blank">$0</a>', $text);
    }

    /**
     * Constructs clickable internal links to Snippets.
     */
    private function createSnippetLinks(string $text, bool $absolute = false): string
    {
        $regex = "/snippet#([0-9]*)(\/\S*)?/";

        if ($absolute) {
            return preg_replace($regex, '<a href="'.config('app.url').'/snippet/$1">Snippet #$1</a>', $text);
        }

        return preg_replace($regex, '<a href="/snippet/$1">Snippet #$1</a>', $text);
    }

    /**
     * Returns HTML from Markdown.
     */
    private function renderMarkdown(string $text): string
    {
        return MarkdownExtra::defaultTransform($text);
    }

    /**
     * Returns HTML without unwanted tags
     * with external and internal links.
     */
    public function render(string $text): string
    {
        $text = $this->renderMarkdown($text);
        $text = $this->stripTags($text);
        $text = $this->createExternalLinks($text);

        return $this->createSnippetLinks($text);
    }

    /**
     * Returns HTML from Markdown file with all tags intact.
     */
    public function renderInclude(string $filename): string
    {
        $path = resource_path('markdown/'.$filename.'.md');

        if (! File::exists($path)) {
            return '';
        }

        $text = $this->renderMarkdown(File::get($path));

        return $this->createSnippetLinks($text);
    }

    /**
     * Returns rendered HTML with absolute links for RSS.
     */
    public function renderForRss(string $text): string
    {
        $text = $this->renderMarkdown($text);
        $text = $this->stripTags($text);
        $text = $this->createExternalLinks($text);

        return $this->createSnippetLinks($text, true);
    }

    /**
     * Escape special characters for XML output.
     */
    public function xmlentities(string $text): string
    {
        return str_replace(['&', '<', '>'], ['&#x26;', '&#x3C;', '&#x3E;'], $text);
    }
}
