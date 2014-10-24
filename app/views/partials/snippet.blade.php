
<div class="col-md-8">
  <h3>{{{ $snippet['title']  }}}</h3>
  <p class="text-muted">{{ $snippet['created_at']->diffForHumans() }} by <strong>{{ $snippet['user']->name }}</strong></p>
  <p>{{{ $snippet['description']  }}}</p>
  <p><a class="btn btn-default btn-sm" href="{{ URL::route('snippet.show', $snippet['id']) }}" role="button">View details &raquo;</a>
  @if (Auth::check() && $snippet['user_id'] === Auth::user()->id)
  <a class="btn btn-default btn-sm" href="{{ URL::route('snippet.edit', $snippet['id']) }}" role="button">Edit &raquo;</a>
  @endif
  </p>
</div>
