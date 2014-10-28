@extends('layouts.main')

@section('content')

<div class="container">

  <div class="row">
    <div class="col-xs-12">
      <h1>Edit snippet</h1>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-6 col-xs-12">
      @if($errors->has())
      <ul class="text-danger">
        @foreach($errors->all() as $message)
        <li>{{ $message }}</li>
        @endforeach
      </ul>
      @endif
      @include('partials.snippet_form')
    </div>
  </div>

</div>

@stop
