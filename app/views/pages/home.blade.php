@extends('layouts.main')

@section('content')

<div class="jumbotron">
  <div class="container">
    <h1 class="wow fadeInDown" data-wow-delay="0.4s" data-wow-duration="1.4s"><i class="fa fa-fire"></i> Share your knowledge</h1>
    <p>Gather your <tt>vimrc</tt> snippets on this site and let others learn from your <abbr title="[fu] The art of doing things.">fu</a>.</p>
    <p><a href="{{ URL::route('snippet.create') }}" class="btn btn-primary btn-lg" role="button">Post your first snippet &raquo;</a></p>
  </div>
</div>

<div class="container">

  <div class="col-sm-6 col-xs-12">
    <div class="row">
      <div class="col-xs-12">
        <h2>New snippets</h2>
      </div>
    </div>
    @foreach($snippets as $snippet)
    @include('partials.snippet', ['img' => true])
    @endforeach
    <div class="row snippet-box">
      <a href="{{ URL::route('snippet.index') }}" class="btn btn-default btn-sm pull-right">Browse all snippets &raquo;</a>
    </div>
  </div>

  <div class="col-sm-4 col-sm-offset-2 col-xs-12">
    @include('partials.statistics')
    @include('partials.search_form')

    <div class="row">
      <div class="col-xs-12">
        <div class="text-muted">
          <h3>Upcoming features</h3>
          <ul>
            <li>Sort by time, number of comments or rating on snippet lists</li>
            <li>Activity notifications</li>
            <li>Snippet tagging</li>
          </ul>
        </div>
      </div>
    </div>

  </div>

</div>

@stop
