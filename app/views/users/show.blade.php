@extends('layouts.main')

@section('title', $user->name)

@section('content')

<div class="container">

  <div class="row">
    <div class="col-xs-12">
      <h1>{{ $user->name }}</h1>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-4 col-xs-12">
      <img src="{{ $user->avatar_url }}&s=100" class="img-responsive img-profile rounded" alt="{{ $user->name }}">
      <p>
        <span class="badge">{{ $total }}</span>
        <a href="{{ URL::route('user.show', $user->id) }}">{{ Str::plural('Snippet', $total) }}</a>
      </p>
      <p>
        <span class="badge">{{ $user->votes->count() }}</span>
        <a href="{{ URL::route('user.votes', $user->id) }}">Up{{ Str::plural('vote', $user->votes->count()) }}</a>
      </p>
      <p>
        <span class="badge">{{ $user->comments->count() }}</span>
        {{ Str::plural('Comment', $user->comments->count()) }}
      </p>
      <p>
        <span class="badge">{{ $tags->count() }}</span>
        {{ Str::plural('Tag', $tags->count()) }}
      </p>
      <p><a href="{{ $user->github_url }}" target="_blank">GitHub Page &raquo;</a></p>
      <div>@include('partials.tagcloud', ['title' => ''])</div>
    </div>

    <div class="col-sm-8 col-xs-12">
      <div class="row">
        <div class="col-xs-12">
          @include('partials.paginator')
        </div>
      </div>
      @foreach($snippets as $snippet)
        @if(Request::is('user/*/upvotes'))
          @include('partials.snippet', ['img' => true])
        @else
          @include('partials.snippet', ['img' => false])
        @endif
      @endforeach
      <div class="row">
        <div class="col-xs-12">
          @include('partials.paginator')
        </div>
      </div>
    </div>
  </div>

</div>

@stop
