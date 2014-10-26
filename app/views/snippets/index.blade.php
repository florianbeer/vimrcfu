@extends('layouts.main')

@section('content')

<div class="container">

  <div class="col-md-8">
    <h1>Browse all snippets</h1>
  </div>
  @include('partials.paginator')

  <div class="col-sm-6 col-xs-12">
     <div class="row">
      @foreach($snippets as $snippet)
        @include('partials.snippet')
      @endforeach
    </div>
  </div>

  @include('partials.paginator')

</div>

@stop
