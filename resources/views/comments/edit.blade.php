@extends('layouts.main')

@section('title', 'Edit your comment')

@section('content')

<div class="container">

  <div class="row">
    <div class="col-xs-12">
      <h1>Edit comment</h1>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-6 col-xs-12">
      <form method="POST" action="{{ route('comment.update', $comment->id) }}">
        @csrf
        @method('PUT')
        <input type="hidden" name="snippet_id" value="{{ $comment->snippet->id }}">
        <div class="form-group">
          @if($errors->any())
          <p class="help-block text-danger">{{ $errors->first('body') }}</p>
          @endif
          <textarea name="body" class="form-control" rows="5" placeholder="Your comment" tabindex="1">{{ old('body', $comment->body) }}</textarea>
          @include('partials.markdown_help')
        </div>
        <button type="submit" class="btn btn-default pull-right" tabindex="2">Submit</button>
      </form>
    </div>
  </div>
</div>

@stop
