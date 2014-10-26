@extends('layouts.main')

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h1>{{{ $snippet->title }}}</h1>
      </div>
      <div class="col-sm-4 col-xs-12">
        <img src="{{ $snippet['user']->avatar_url }}" class="img-rounded col-sm-6 col-xs-4">
        <strong>{{ HTML::linkRoute('user.show', $snippet['user']->name, $snippet['user']->id) }}</strong>
        <p class="text-muted">{{ $snippet->created_at->diffForHumans() }}</p>
        @if(Auth::check() && Auth::user()->id == $snippet->user_id)
          <a class="btn btn-default btn-sm" href="{{ URL::route('snippet.edit', $snippet['id']) }}" role="button">Edit &raquo;</a>
        @elseif(Auth::check())
          <div>
            <a href="{{ URL::route('vote.up', $snippet['id']) }}" class="votelink up {{ $snippet->hasUserVoted(Auth::user()->id) === 1 ?: 'dark' }}"><i class="fa fa-arrow-circle-up"></i></a>
            <span class="score text-center">{{ $snippet->getScore() }}</span>
            <a href="{{ URL::route('vote.down', $snippet['id']) }}" class="votelink down {{ $snippet->hasUserVoted(Auth::user()->id) === -1 ?: 'dark' }}"><i class="fa fa-arrow-circle-down"></i></a>
          </div>
        @endif
      </div>
      <div class="col-sm-8 col-xs-12">
        <p>{{{ $snippet->description }}}</p>
        <pre>{{{ $snippet->body }}}</pre>
      </div>
    </div>
  </div>
  
  <div class="container">
    @if($snippet->comments->count() || Auth::check())
    <hr>
    @endif
    <div class="row">
      @if(Auth::check())
      <div class="col-sm-5 col-xs-12 pull-right comment-form">
        {{ Form::open(['route' => 'comment.store']) }}
        {{ Form::hidden('snippet_id', $snippet->id) }}
          <div class="form-group">
            @if($errors->has())
              <p class="help-block text-danger">{{ $errors->first('body') }}</p>
            @endif
            {{ Form::textarea('body', null, ['class' => 'form-control', 'rows' => '5', 'placeholder' => 'Your comment', 'tabindex' => '1', 'value' => Input::old('comment')]) }}
            <p class="help-block"><span class="small text-muted">You can use <strong>some markdown</strong> in your comment.<br>
            Italics (*), bold (**), inline code (`), code blocks without newlines (```) and blockquotes (>) are supported.</span></p>
          </div>
          <button type="submit" class="btn btn-default pull-right" tabindex="2">Submit</button>
        {{ Form::close() }}
      </div>
      @endif
      <div class="col-sm-7 col-xs-12">
      @foreach($comments as $comment)
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
      @endforeach
      </div>
    </div>
  </div>
@stop
