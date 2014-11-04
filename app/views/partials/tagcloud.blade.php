@if(count($tags))
  @if($title)
    <h2>{{{ $title or 'Popular Tags' }}} </h2>
  @endif
  @foreach($tags as $i => $tag)
    <a href="/tag/{{{ $tag->slug }}}" class="label label-default wow bounceIn" data-wow-delay=".{{ $i }}s">{{{ $tag->name }}}</a>
  @endforeach
@endif
