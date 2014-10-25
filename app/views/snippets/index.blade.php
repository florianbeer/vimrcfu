@extends('layouts.main')

@section('content')

<div class="container">
   <div class="row">
    <div class="col-md-8">
      <h1>Browse all snippets</h1>
    </div>
    @include('partials.paginator')
    @foreach($snippets as $snippet)
      @include('partials.snippet')
    @endforeach
    @include('partials.paginator')
  </div>
</div>

@stop
