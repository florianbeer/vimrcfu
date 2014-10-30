@if(empty($snippet->title))
{{ Form::model($snippet, ['route' => 'snippet.store']) }}
@else
{{ Form::model($snippet, ['route' => ['snippet.update', $snippet->id], 'method' => 'PUT']) }}
@endif
<div class="form-group">
  <label for="title">Snippet Title</label>
  {{ Form::text('title', null, ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Enter a descriptive title', 'autofocus']) }}
</div>
<div class="form-group">
  <label for="description">Description</label>
  <p class="help-block">Describe exactly what your snippet achieves or which behaviour it adds.</p>
  {{ Form::textarea('description', null, ['class' => 'form-control', 'id' => 'description', 'rows' => '3']) }}
  @include('partials.markdown_help')
</div>
<div class="form-group">
  <label for="body">Snippet</label>
  <p class="help-block">Paste your snippet here.</p>
  {{ Form::textarea('body', null, ['class' => 'form-control snippet', 'id' => 'body', 'rows' => '6']) }}
</div>
<button type="submit" class="btn btn-primary">Submit</button>
{{ Form::close() }}
