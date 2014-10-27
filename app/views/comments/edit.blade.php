@extends('layouts.main')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8">
      <h1>Edit comment</h1>
    </div>
    <div class="col-md-8">
      {{ Form::model($comment, ['route' => ['comment.update', $comment->id], 'method' => 'PUT']) }}
      {{ Form::hidden('snippet_id', $comment->snippet->id) }}
      <div class="form-group">
        @if($errors->has())
        <p class="help-block text-danger">{{ $errors->first('body') }}</p>
        @endif
        {{ Form::textarea('body', null, ['class' => 'form-control', 'rows' => '5', 'placeholder' => 'Your comment', 'tabindex' => '1', 'value' => Input::old('comment')]) }}
        <p class="help-block"><span class="small text-muted">You can use <strong>some markdown</strong>.<br>
          Italics (*), bold (**), inline code (`), code blocks without newlines (```) and blockquotes (>) are supported.</span></p>
      </div>
      <button type="submit" class="btn btn-default pull-right" tabindex="2">Submit</button>
      {{ Form::close() }}
    </div>
  </div>
</div>
@stop
