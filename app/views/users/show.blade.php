@extends('layouts.main')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1>{{ $user->name }}</h1>
    </div>
    <div class="col-sm-4 col-xs-12">
      <img src="{{ $user->avatar_url }}" class="img-rounded col-sm-6 col-xs-4">
      <p><span class="badge">{{ $snippets->getTotal() }}</span>
        @if($snippets->getTotal() == 1)
        Snippet
        @else
        Snippets
        @endif
      </p>
      <p><span class="badge">{{ count($user->comments) }}</span>
        @if(count($user->comments) == 1)
        Comment
        @else
        Comments
        @endif
      </p>
      <p><a href="{{ $user->github_url }}">&raquo; GitHub Page</a></p>
    </div>
    <div class="col-sm-8 col-xs-12">
      @include('partials.paginator')
      @foreach($snippets as $snippet)
        @include('partials.snippet')
      @endforeach
      @include('partials.paginator')
    </div>
  </div>
</div>

@stop
