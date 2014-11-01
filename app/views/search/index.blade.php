@extends('layouts.main')

@section('title', 'Search Results')

@section('content')

<div class="container">

  <div class="row">
    <div class="col-sm-8 col-xs-12">
      <h1>Search for <em>{{ Input::get('q') }}</em></h1>
      <div class="text-muted">
        {{ $total }} {{ Str::plural('Result', $total) }}<br>
        @if($snippets->getLastPage() > 1)
          Page {{ $snippets->getCurrentPage() }} of {{ $snippets->getLastPage() }}
        @endif
      </div>
    </div>

    <div class="col-sm-4 col-xs-12">
      @include('partials.search_form')
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12">
      @include('partials.paginator')
    </div>
  </div>

  <div class="row">
    <div class="col-sm-6 col-xs-12">
      @foreach($snippets as $snippet)
      @include('partials.snippet', ['img' => true])
      @endforeach
    </div>

    <div class="col-sm-4 col-sm-offset-2 col-xs-12">
      @include('partials.tagcloud', ['title' => 'Related ' . Str::plural('Tag', count($tags))])
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12">
      @include('partials.paginator')
    </div>
  </div>

</div>

@stop
