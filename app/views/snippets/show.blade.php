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
        <?php $score = $snippet->score; ?>
        <span class="text-center"><i class="fa fa-fire"></i> <span class="points">{{ $score }}</span> {{ Str::plural('Point', $score) }}</span>
        @if(Auth::check())
        <?php $voted = $snippet->hasUserVoted(Auth::user()->id); ?>
        <a href="{{ URL::route('vote.up', $snippet['id']) }}" title="vote up" class="votelink up {{ $voted === 1 ?: 'dark' }}"><i class="fa fa-arrow-circle-up"></i></a>
        <a href="{{ URL::route('vote.down', $snippet['id']) }}" title="vote down" class="votelink down {{ $voted === -1 ?: 'dark' }}"><i class="fa fa-arrow-circle-down"></i></a>
        @endif
      </div>
    </div>
  </div>

  <hr>

  <div class="row">
    <div class="col-sm-4 col-xs-12">
      <img src="{{ $snippet['user']->avatar_url }}" class="img-responsive img-profile" alt="{{ $snippet['user']->name }}">
      <strong>{{ HTML::linkRoute('user.show', $snippet['user']->name, $snippet['user']->id) }}</strong>
      <p class="text-muted">{{ $snippet->created_at->diffForHumans() }}</p>
      @if(Auth::check() && Auth::user()->id == $snippet->user_id)
      <a class="btn btn-default btn-sm" href="{{ URL::route('snippet.edit', $snippet['id']) }}" role="button">Edit &raquo;</a>
      @endif
    </div>

    <div class="col-sm-8 col-xs-12">
      {{ Text::render($snippet->description) }}
      <pre>{{{ $snippet->body }}}</pre>
    </div>
    <div class="col-sm-offset-4 col-sm-8 col-xs-12">
      @foreach($snippet->tags as $tag)
        <a href="{{ URL::route('tag.show', $tag->slug) }}" class="label label-default">{{ $tag->name }}</a>
      @endforeach
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
      @foreach($snippet->comments as $comment)
      @include('partials.comment')
      @endforeach
    </div>
  </div>

</div>

@stop
