@if(count($tags))
  @if($title ?? 'Popular Tags')
    <h2>{{ $title ?? 'Popular Tags' }}</h2>
  @endif
  @foreach($tags as $i => $tag)
    <a href="/tag/{{ $tag->slug }}" class="label label-default wow bounceIn" data-wow-delay="{{ $i/10 }}s">{{ $tag->name }}</a>
  @endforeach
@endif
