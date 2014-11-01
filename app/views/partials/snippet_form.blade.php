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
  {{ Form::textarea('description', null, ['class' => 'form-control', 'id' => 'description', 'placeholder' => 'Describe exactly what your snippet achieves or which behaviour it adds.', 'rows' => '3']) }}
  @include('partials.markdown_help')
</div>
<div class="form-group">
  <label for="description">Tags</label>
  {{ Form::text('tags', implode(',', $snippet->tagnames()), ['class' => 'form-control', 'id' => 'tags', 'placeholder' => 'Choose tags', 'data-role' => 'tagsinput']) }}
</div>
<div class="form-group">
  <label for="body">Snippet</label>
  {{ Form::textarea('body', null, ['class' => 'form-control snippet', 'id' => 'body', 'placeholder' => 'Paste your snippet here.', 'rows' => '6']) }}
</div>
<button type="submit" class="btn btn-primary">Submit</button>
{{ Form::close() }}

@section('script')
{{ HTML::script('js/vendor/bootstrap-tagsinput.min.js') }}
{{ HTML::script('js/vendor/typeahead.bundle.min.js') }}
{{ HTML::script('js/tagging.js') }}
@stop
