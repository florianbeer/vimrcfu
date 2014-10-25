@extends('layouts.main')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1>{{ $user->name }}</h1>
    </div>
    <div class="col-md-4">
      <img src="{{ $user->avatar_url }}" class="img-rounded col-md-6 col-xs-2">
      <p><span class="badge">{{ count($snippets) }}</span>
        @if(count($snippets) == 1)
        Snippet
        @else
        Snippets
        @endif
      </p>
      <p><a href="{{ $user->github_url }}">&raquo; GitHub Page</a></p>
    </div>
    <div class="col-md-8">
      @foreach($snippets as $snippet)
        @include('partials.snippet')
      @endforeach
    </div>
  </div>
</div>

@stop
