@extends('layouts.main')

@section('title', 'Search Results')

@section('content')

<div class="container">

  <div class="row">
    <div class="col-sm-8 col-xs-12">
      <h1>Search for <em>{{ Input::get('q') }}</em></h1>
      <div class="text-muted">
        {{ $snippets->getTotal() }} {{ Str::plural('Result', $snippets->count()) }}<br>
        Page {{ $snippets->getCurrentPage() }} of {{ $snippets->getLastPage() }}
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
  </div>

  <div class="row">
    <div class="col-xs-12">
      @include('partials.paginator')
    </div>
  </div>

</div>

@stop
