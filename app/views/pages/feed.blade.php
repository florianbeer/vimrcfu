<?php echo '
<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0"
  xmlns:content="http://purl.org/rss/1.0/modules/content/"
  xmlns:wfw="http://wellformedweb.org/CommentAPI/"
  xmlns:dc="http://purl.org/dc/elements/1.1/"
  xmlns:atom="http://www.w3.org/2005/Atom"
  xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
  xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
  >
'; ?>

<channel>
  <title>vimrcfu - Share your best vimrc snippets.</title>
  <atom:link href="{{ Config::get('app.url') }}/feed" rel="self" type="application/rss+xml" />
  <link>{{ Config::get('app.url') }}</link>
  <description>Gather your vimrc snippets on this site and let others learn from your fu.</description>
  <lastBuildDate>{{ \Carbon\Carbon::createFromTimeStamp(time())->toRssString() }}</lastBuildDate>
  <language>en-US</language>
  <sy:updatePeriod>hourly</sy:updatePeriod>
  <sy:updateFrequency>1</sy:updateFrequency>
  <generator>http://vimrcfu.com</generator>
  @foreach($snippets as $snippet)
  <item>
    <title>{{ Text::xmlentities($snippet->title) }}</title>
    <link>{{ Config::get('app.url') }}/snippet/{{ $snippet->id }}</link>
    <pubDate>{{ $snippet->created_at->toRssString() }}</pubDate>
    <dc:creator><![CDATA[{{ $snippet->user->name }}]]></dc:creator>
    <guid isPermaLink="true">http://vimrcfu.com/snippet/{{ $snippet->id }}</guid>
    <description><![CDATA[{{ Text::renderForRss($snippet->description) }}]]></description>
    <content:encoded><![CDATA[<p>{{ Text::renderForRss($snippet->description) }}</p><p><pre>{{ htmlentities($snippet->body) }}</pre></p>]]></content:encoded>
  </item>
  @endforeach
</channel>
</rss>
