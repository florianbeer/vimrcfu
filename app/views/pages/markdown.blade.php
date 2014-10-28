@extends('layouts.main')

@section('title', $title);

@section('content')

<div class="container">
  <div class="row">
    <div class="col-sm-8 col-xs-12">
      {{ Text::renderInclude($file) }}
    </div>
  </div>
</div>

@stop
