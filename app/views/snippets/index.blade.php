@extends('layouts.main')

@section('content')

<div class="container">
   <div class="row">
    <h1>Browse all snippets</h1>
    @include('partials.paginator')
    @foreach($snippets as $snippet)
      @include('partials.snippet')
    @endforeach
    @include('partials.paginator')
  </div>
</div>

@stop
