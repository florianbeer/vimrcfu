@extends('layouts.main')

@section('content')

<div class="container">

  <div class="col-md-8">
    <div class="row">
      <h1>{{ $snippets->count() }} Search {{ Str::plural('Result', $snippets->count()) }}</h1>
    </div>
  </div>

  <div class="col-sm-4 col-xs-12">
    @include('partials.search_form')
  </div>

  @include('partials.paginator')

  <div class="col-sm-6 col-xs-12">
    <div class="row">
      @foreach($snippets as $snippet)
      @include('partials.snippet', ['img' => true])
      @endforeach
    </div>
  </div>


  @include('partials.paginator')

</div>

@stop
