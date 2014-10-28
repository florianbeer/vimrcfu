@extends('layouts.main')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-sm-8 col-xs-12">
      {{ Text::renderInclude('faq') }}
    </div>
  </div>
</div>

@stop
