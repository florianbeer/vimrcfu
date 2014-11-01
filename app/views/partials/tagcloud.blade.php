@if(count($tags))
<h2>{{{ $title or 'Popular Tags' }}} </h2>
@foreach($tags as $tag)
  <a href="/tag/{{{ $tag->slug }}}" class="label label-default">{{{ $tag->name }}}</a>
@endforeach
@endif
