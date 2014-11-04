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
      <img src="{{ $user->avatar_url }}&s=100" class="img-responsive img-profile" alt="{{ $user->name }}">
      <p>
        <span class="badge">{{ $total }}</span>
        {{ Str::plural('Snippet', $total) }}
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
        @include('partials.snippet', ['img' => false])
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
