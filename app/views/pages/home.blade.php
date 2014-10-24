@extends('layouts.main')

@section('content')

    <div class="jumbotron">
      <div class="container">
        <h1>Share your knowledge</h1>
        <p>VIM users are religious about their editor configuration. This site lets you share your fu so we can learn from each other by what we put into our <tt>vimrc</tt> files.</p>
        <p><a href="{{ URL::route('snippet.create') }}" class="btn btn-primary btn-lg" role="button">Post your first snippet&raquo;</a></p>
      </div>
    </div>
    <div class="container">
      <div class="row">
        @foreach($snippets as $snippet)
        <div class="col-md-8">
          <h2>{{ $snippet['title']  }}</h2>
          <p class="text-muted">{{ $snippet['created_at']->diffForHumans() }} by <strong>{{ $snippet['user']->name }}</strong></p>
          <p>{{ $snippet['description']  }}</p>
          <p><a class="btn btn-default" href="{{ URL::route('snippet.show', $snippet['id']) }}" role="button">View details &raquo;</a></p>
        </div>
        @endforeach
      </div>
    </div>

@stop
