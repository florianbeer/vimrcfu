@extends('layouts.main')

@section('content')

<div class="container">

  <div class="row">
    <div class="col-xs-12">
      <h1>{{ $user->name }}</h1>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-4 col-xs-12">
      <img src="{{ $user->avatar_url }}" class="img-responsive img-profile">
      <p>
      <span class="badge">{{ $snippets->getTotal() }}</span>
      {{ Str::plural('Snippet', $snippets->getTotal()) }}
      </p>
      <p>
      <span class="badge">{{ count($user->comments) }}</span>
      {{ Str::plural('Comment', count($user->comments)) }}
      </p>
      <p><a href="{{ $user->github_url }}">GitHub Page &raquo;</a></p>
    </div>

    <div class="col-sm-8 col-xs-12">
      <div class="row">
        @include('partials.paginator')
      </div>
      @foreach($snippets as $snippet)
      @include('partials.snippet', ['img' => false])
      @endforeach
      <div class="row">
        @include('partials.paginator')
      </div>
    </div>
  </div>

</div>

@stop
