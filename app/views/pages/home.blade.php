@extends('layouts.main')

@section('content')

    <div class="jumbotron">
      <div class="container">
        <h1>Share your knowledge</h1>
        <p>VIM users are religious about their editor configuration. This site lets you share your fu so we can learn from each other by what we put into our <tt>vimrc</tt> files.</p>
        <p><a href="{{ URL::route('snippet.create') }}" class="btn btn-primary btn-lg" role="button">Post your first snippet &raquo;</a></p>
      <div class="text-muted">
        <strong>Coming updates</strong>
        <ul>
          <li>Voting for snippets</li>
          <li>Search</li>
        </ul>
      </div>

        <a href="https://twitter.com/share" class="twitter-share-button" data-hashtags="vimrcfu">Tweet</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <h2>Newest snippets</h2>
        </div>
      </div>
      <div class="row">
        @foreach($snippets as $snippet)
        <div class="col-md-4 snippet-box-sm">
          <h3><a href="{{ URL::route('snippet.show', $snippet['id']) }}">{{{ $snippet['title'] }}}</a></h3>
          <p class="text-muted">{{ $snippet['created_at']->diffForHumans() }} by <a href="{{ URL::route('user.show', $snippet['user']->id)  }}">{{ $snippet['user']->name }}</a></p>
          <p>{{{ str_limit($snippet['description'], $limit = 120, $end = '...') }}}</p>
        </div>
        @endforeach
      </div>
    </div>

@stop
