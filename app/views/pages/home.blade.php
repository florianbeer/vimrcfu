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
            <h2>Newest snippets</h2>
          </div>
        </div>
        @foreach($snippets as $snippet)
        <div class="row home-box">
          <div class="col-md-2 col-sm-3 col-xs-3">
            <img src="{{ $snippet['user']->avatar_url }}" class="img-rounded img-responsive">
          </div>
          <div class="col-md-10 col-sm-9 col-xs-9">
            <h3><a href="{{ URL::route('snippet.show', $snippet['id']) }}">{{{ $snippet['title'] }}}</a></h3>
            <p class="text-muted">{{ $snippet['created_at']->diffForHumans() }} by <a href="{{ URL::route('user.show', $snippet['user']->id)  }}">{{ $snippet['user']->name }}</a></p>
            <p>{{{ str_limit($snippet['description'], $limit = 120, $end = '...') }}}</p>
          </div>
        </div>
        @endforeach
      </div>

      <div class="col-sm-4 col-sm-offset-2 col-xs-12">
        <div class="row">
          <div class="col-xs-12">
            <h2>Statistics</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <ul class="list-group">
              <li class="list-group-item">
                <span class="badge">{{ $snippets_count  }}</span>
                Snippets 
              </li>
              <li class="list-group-item">
                <span class="badge">{{ $comments_count  }}</span>
                Comments
              </li>
              <li class="list-group-item">
                <span class="badge">{{ $users_count  }}</span>
                Users
              </li>
            </ul>  
          </div>
        </div>
        
        <div class="row">
          <div class="col-xs-12">
            <div class="text-muted">
              <h3>Coming updates</h3>
              <ul>
                <li>Voting for snippets</li>
                <li>Activity notifications</li>
                <li>Snippet tagging</li>
                <li>Search</li>
              </ul>
            </div>
          </div>
        </div>

      </div>


    </div>

@stop
