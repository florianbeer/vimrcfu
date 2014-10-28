@extends('layouts.main')

@section('title', $snippet->title)

@section('content')

<div class="container">

  <div class="row">
    <div class="col-sm-7 col-xs-12">
      <h1>{{{ $snippet->title }}}</h1>
    </div>

    <div class="col-sm-5 col-xs-12">
      <div class="score pull-right text-muted">
        <span class="text-center"><i class="fa fa-fire"></i> <span class="points">{{ $snippet->getScore() }}</span> {{ Str::plural('Point', $snippet->getScore()) }}</span>
        @if(Auth::check())
        <a href="{{ URL::route('vote.up', $snippet['id']) }}" title="vote up" class="votelink up {{ $snippet->hasUserVoted(Auth::user()->id) === 1 ?: 'dark' }}"><i class="fa fa-arrow-circle-up"></i></a>
        <a href="{{ URL::route('vote.down', $snippet['id']) }}" title="vote down" class="votelink down {{ $snippet->hasUserVoted(Auth::user()->id) === -1 ?: 'dark' }}"><i class="fa fa-arrow-circle-down"></i></a>
        @endif
      </div>
    </div>
  </div>

  <hr>

  <div class="row">
    <div class="col-sm-4 col-xs-12">
      <img src="{{ $snippet['user']->avatar_url }}" class="img-responsive img-profile">
      <strong>{{ HTML::linkRoute('user.show', $snippet['user']->name, $snippet['user']->id) }}</strong>
      <p class="text-muted">{{ $snippet->created_at->diffForHumans() }}</p>
      @if(Auth::check() && Auth::user()->id == $snippet->user_id)
      <a class="btn btn-default btn-sm" href="{{ URL::route('snippet.edit', $snippet['id']) }}" role="button">Edit &raquo;</a>
      @endif
    </div>

    <div class="col-sm-8 col-xs-12">
      <p>{{ Text::render($snippet->description) }}</p>
      <pre>{{{ $snippet->body }}}</pre>
    </div>
  </div>

  @if($snippet->comments->count() || Auth::check())
  <hr>
  @endif

  <div class="row">
    <div class="col-sm-5 col-xs-12 pull-right">
      @if(Auth::check())
      @include('partials.comment_form')
      @endif
    </div>
    <div class="col-sm-7 col-xs-12">
      @foreach($comments as $comment)
      @include('partials.comment')
      @endforeach
    </div>
  </div>

</div>

@stop
