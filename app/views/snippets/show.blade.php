@extends('layouts.main')

@section('content')

<div class="container">

  <div class="row">
    <div class="col-xs-12">
      <h1>{{{ $snippet->title }}}</h1>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-4 col-xs-12">
      <img src="{{ $snippet['user']->avatar_url }}" class="img-responsive img-profile">
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
      <p>{{ $snippet->getMarkdownBody($snippet->description) }}</p>
        <pre>{{{ $snippet->body }}}</pre>
      </div>
    </div>
  </div>

  <div class="container">
    @if($snippet->comments->count() || Auth::check())
    <hr>
    @endif
    <div class="row">
      @include('partials.comment_form')
      <div class="col-sm-7 col-xs-12">
        @foreach($comments as $comment)
        @include('partials.comment')
        @endforeach
      </div>
    </div>
  </div>

</div>

@stop
