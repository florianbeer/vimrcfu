<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  @foreach($snippets as $snippet)
  <url>
    <loc>{{ route('snippet.show', $snippet->id) }}</loc>
    <lastmod>{{ $snippet->updated_at->format('Y-m-d') }}</lastmod>
  </url>
  @endforeach

  @foreach($users as $user)
  <url>
    <loc>{{ route('user.show', $user->id) }}</loc>
    <lastmod>{{ $user->updated_at->format('Y-m-d') }}</lastmod>
  </url>
  @endforeach

  @foreach($tags as $tag)
  <url>
    <loc>{{ route('tag.show', $tag->slug) }}</loc>
  </url>
  @endforeach

  @foreach($static as $page)
  <url>
    <loc>{{ url($page) }}</loc>
    <changefreq>monthly</changefreq>
  </url>
  @endforeach
</urlset>
