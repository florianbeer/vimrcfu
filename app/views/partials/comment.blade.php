<div class=" comment-box">
  <div class="col-xs-2">
    <img src="{{ $comment->user->avatar_url }}" class="img-rounded img-responsive">
  </div>
  <div class="col-xs-10">
    <p><a href="{{ URL::route('user.show', $comment->user_id) }}">{{ $comment->user->name }}</a>
    <span class="text-muted small">
      {{ $comment->created_at->diffForHumans() }}
      @if(Auth::check() && Auth::user()->id == $comment->user_id)
      <a href="{{ URL::route('comment.edit', $comment->id) }}">[edit]</a>
      @endif
    </span>
    @if($comment->created_at != $comment->updated_at && $comment->created_at->diffInMinutes($comment->updated_at) > 5)
    <span class="pull-right text-muted" title="Edited" style="cursor:help;">&#9998;</span>
    @endif
    </p>
    {{ $comment->getMarkdownBody($comment->body) }}
  </div>
</div>
