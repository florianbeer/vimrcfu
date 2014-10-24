@extends('layouts.main')

@section('content')

<div class="container">

  <div class="row">
    <div class="col-md-12">
      <div class="pull-right">
        {{ $snippets->links() }}
      </div>
    </div>
  </div>
 
   <div class="row">

        @foreach($snippets as $snippet)
          @include('partials.snippet')
        @endforeach


  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="pull-right">
        {{ $snippets->links() }}
      </div>
    </div>
  </div>

</div>

@stop
