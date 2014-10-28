@extends('layouts.main')

@section('content')

<div class="container">

  <div class="row">
    <div class="col-xs-12">
      <h1>Edit comment</h1>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-6 col-xs-12">
      {{ Form::model($comment, ['route' => ['comment.update', $comment->id], 'method' => 'PUT']) }}
      {{ Form::hidden('snippet_id', $comment->snippet->id) }}
      <div class="form-group">
        @if($errors->has())
        <p class="help-block text-danger">{{ $errors->first('body') }}</p>
        @endif
        {{ Form::textarea('body', null, ['class' => 'form-control', 'rows' => '5', 'placeholder' => 'Your comment', 'tabindex' => '1', 'value' => Input::old('comment')]) }}
       @include('partials.markdown_help') 
      </div>
      <button type="submit" class="btn btn-default pull-right" tabindex="2">Submit</button>
      {{ Form::close() }}
    </div>
  </div>
</div>

@stop
