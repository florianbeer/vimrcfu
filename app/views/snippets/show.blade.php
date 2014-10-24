@extends('layouts.main')

@section('content')

  <div class="container">
    <div class="row">
      <h1>{{ $snippet->title  }}</h1>
      <div class="col-md-4">
        <img src="{{ $snippet['user']->avatar_url }}" class="img-rounded col-md-6">
        <strong>{{ HTML::link($snippet['user']->github_url, $snippet['user']->name) }}</strong>
        <p class="text-muted">{{ $snippet->created_at->diffForHumans() }}</p>
      </div>
      <div class="col-md-8">
        <p>{{ $snippet->description }}</p>
        <pre>{{ $snippet->body }}</pre>
      </div>
    </div>
  </div>

@stop
