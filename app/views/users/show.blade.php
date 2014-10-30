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
      <img src="{{ $user->avatar_url }}" class="img-responsive img-profile" alt="{{ $user->name }}">
      <p>
      <?php $snippetsTotal = $snippets->getTotal(); ?>
      <span class="badge">{{ $snippetsTotal }}</span>
      {{ Str::plural('Snippet', $snippetsTotal) }}
      </p>
      <p>
      <?php $commentsTotal = count($user->comments); ?>
      <span class="badge">{{ $commentsTotal }}</span>
      {{ Str::plural('Comment', $commentsTotal) }}
      </p>
      <p><a href="{{ $user->github_url }}">GitHub Page &raquo;</a></p>
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
