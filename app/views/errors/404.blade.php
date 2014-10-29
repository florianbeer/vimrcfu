@extends('layouts.main')

@section('title', 'Not found')

@section('content')

<div class="jumbotron" style="height: 80vh;">
  <div class="container">
    <h1 class="wow bounceInDown" data-wow-duration="2s">
      <i class="fa fa-bomb"></i> Not found
    </h1>
    <p>The page you are looking for was not found. You can go to the <a href="/">home page</a>, browse <a href="/snippet">all snippets</a> or try a search:</p>
    <div class="row">
      <div class="col-sm-6 col-xs-12">
        @include('partials.search_form')
      </div>
    </div>
  </div>
</div>


@stop
