@extends('layouts.main')

@section('content')

<div class="container">

  <div class="row">
    <div class="col-md-8">
      <h1>Edit snippet</h1>
    </div>
    <div class="col-md-8">
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
