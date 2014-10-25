@extends('layouts.main')

@section('content')

<div class="container">

@include('partials.paginator')
 
   <div class="row">

        @foreach($snippets as $snippet)
          @include('partials.snippet')
        @endforeach


  </div>

@include('partials.paginator')

</div>

@stop
