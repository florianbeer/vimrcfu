
<div class="col-md-8">
  <h3><a href="{{ URL::route('snippet.show', $snippet['id']) }}">{{{ $snippet['title'] }}}</a></h3>
  <p class="text-muted">
    {{ $snippet['created_at']->diffForHumans() }} by <a href="{{ URL::route('user.show', $snippet['user']->id)  }}">{{ $snippet['user']->name }}</a>,
    {{ count($snippet->comments) }} {{ Str::plural('Comment', count($snippet->comments)) }}
  </p>
  <p>{{{ $snippet['description']  }}}</p>
  @if (Auth::check() && $snippet['user_id'] === Auth::user()->id)
  <p>
  <a class="btn btn-default btn-sm" href="{{ URL::route('snippet.edit', $snippet['id']) }}" role="button">Edit &raquo;</a>
  </p>
  @endif
</div>
