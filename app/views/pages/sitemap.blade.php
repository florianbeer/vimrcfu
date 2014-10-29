{{ '<?xml version="1.0" encoding="UTF-8"?>'."\n" }}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  @foreach($snippets as $snippet)
  <url>
    <loc>{{ URL::route('snippet.show', $snippet->id) }}</loc>
    <lastmod>{{date('Y-m-d', strtotime($snippet->updated_at))}}</lastmod>
  </url>
  @endforeach

  @foreach($users as $user)
  <url>
    <loc>{{ URL::route('user.show', $user->id) }}</loc>
    <lastmod>{{date('Y-m-d', strtotime($user->updated_at))}}</lastmod>
  </url>
  @endforeach

  @foreach($static as $page)
  <url>
    <loc>{{URL::to($page)}}</loc>
    <changefreq>monthly</changefreq>
  </url>
  @endforeach
</urlset>
