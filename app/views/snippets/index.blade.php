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
        <div class="col-md-8">
          <h2>{{{ $snippet['title']  }}}</h2>
          <p class="text-muted">{{ $snippet['created_at']->diffForHumans() }} by <strong>{{ $snippet['user']->name }}</strong></p>
          <p>{{{ $snippet['description']  }}}</p>
          <p><a class="btn btn-default" href="{{ URL::route('snippet.show', $snippet['id']) }}" role="button">View details &raquo;</a></p>
        </div>
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
