@extends('layouts.main')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-8">
      <h1>New snippet</h1>
    </div>
    <div class="col-md-8">
      @if($errors->has())
      <ul>
      @foreach($errors->all() as $message)
        <li>{{ $message }}</li>
      @endforeach
      </ul>
      @endif
      {{ Form::open(['route' => 'snippet.store']) }}
        <div class="form-group">
          <label for="Title">Snippet Title</label>
          <input type="text" name="title" class="form-control" id="title" autofocus placeholder="Enter a descriptive title" value="{{ Input::old('title') }}">
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <p class="help-block">Describe exactly what your snippet achieves or which behaviour it adds.</p>
          <textarea class="form-control" name="description" id="description" rows="3">{{ Input::old('description') }}</textarea>
        </div>
        <div class="form-group">
          <label for="body">Snippet</label>
          <p class="help-block">Paste your snippet here. This field will be parsed with <strong>markdown</strong>.</p>
          <textarea class="form-control" name="body" id="body" rows="6">{{ Input::old('body') }}</textarea>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      {{ Form::close() }}
    </div>
  </div>
</div>

@stop
