@if(empty($snippet->id))
<form method="POST" action="{{ route('snippet.store') }}">
@else
<form method="POST" action="{{ route('snippet.update', $snippet->id) }}">
  @method('PUT')
@endif
  @csrf
  <div class="form-group">
    <label for="title">Snippet Title</label>
    <input type="text" name="title" value="{{ old('title', $snippet->title) }}" class="form-control" id="title" placeholder="Enter a descriptive title" autofocus>
  </div>
  <div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" class="form-control" id="description" placeholder="Describe exactly what your snippet achieves or which behaviour it adds." rows="3">{{ old('description', $snippet->description) }}</textarea>
    @include('partials.markdown_help')
  </div>
  <div class="form-group">
    <label for="tags">Tags</label>
    <input type="text" name="tags" value="{{ old('tags', implode(',', $snippet->id ? $snippet->tagnames() : [])) }}" class="form-control" id="tags" placeholder="Choose tags" data-role="tagsinput">
  </div>
  <div class="form-group">
    <label for="body">Snippet</label>
    <textarea name="body" class="form-control snippet" id="body" placeholder="Paste your snippet here." rows="6">{{ old('body', $snippet->body) }}</textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

@section('script')
<script src="{{ asset('js/vendor/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('js/vendor/typeahead.bundle.min.js') }}"></script>
<script src="{{ asset('js/tagging.js') }}"></script>
@stop
