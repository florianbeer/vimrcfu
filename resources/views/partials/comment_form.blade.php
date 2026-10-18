<form method="POST" action="{{ route('comment.store') }}" class="comment-form clearfix">
  @csrf
  <input type="hidden" name="snippet_id" value="{{ $snippet->id }}">
  <div class="form-group">
    @if($errors->any())
    <p class="help-block text-danger">{{ $errors->first('body') }}</p>
    @endif
    <textarea name="body" class="form-control" rows="5" placeholder="Your comment" tabindex="1">{{ old('body') }}</textarea>
    @include('partials.markdown_help')
  </div>
  <button type="submit" class="btn btn-default pull-right" tabindex="2">Submit</button>
</form>
