@extends('layouts.main')

@section('content')

<div class="container">

  <div class="row">
    <div class="col-sm-8 col-xs-12">
      <h1>Browse all snippets</h1>
      <div class="text-muted">
        {{ $snippets->getTotal() }} {{ Str::plural('Snippet', $snippets->count()) }}<br>
        Page {{ $snippets->getCurrentPage() }} of {{ $snippets->getLastPage() }}
      </div>
    </div>

    @include('partials.search_form')
  </div>

  <div class="row">
    @include('partials.paginator')
  </div>

  <div class="row">
    <div class="col-sm-6 col-xs-12">
      @foreach($snippets as $snippet)
      @include('partials.snippet', ['img' => true])
      @endforeach
    </div>
  </div>

  <div class="row">
    @include('partials.paginator')
  </div>


</div>

@stop
