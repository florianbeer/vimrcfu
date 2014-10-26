@if(empty($snippet->title))
{{ Form::model($snippet, ['route' => 'snippet.store']) }}
@else
{{ Form::model($snippet, ['route' => ['snippet.update', $snippet->id], 'method' => 'PUT']) }}
@endif
  <div class="form-group">
    <label for="title">Snippet Title</label>
    {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter a descriptive title', 'autofocus']) }}
  </div>
  <div class="form-group">
    <label for="description">Description</label>
    <p class="help-block">Describe exactly what your snippet achieves or which behaviour it adds.</p>
    {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => '3']) }}
    <p class="help-block"><span class="small text-muted">You can use <strong>some markdown</strong>.<br>
    Italics (*), bold (**), inline code (`), code blocks without newlines (```) and blockquotes (>) are supported.</span></p>
  </div>
  <div class="form-group">
    <label for="body">Snippet</label>
    <p class="help-block">Paste your snippet here.</p>
    {{ Form::textarea('body', null, ['class' => 'form-control snippet', 'rows' => '6']) }}
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
{{ Form::close() }}
