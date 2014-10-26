<div class="row snippet-box">
  @if($img == true)
  <div class="col-md-2 col-sm-3 col-xs-3">
    <img src="{{ $snippet['user']->avatar_url }}" class="img-responsive">
  </div>
  <div class="col-md-10 col-xs-9">
  @else
  <div class="col-md-10 col-xs-12">
  @endif
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
</div>
