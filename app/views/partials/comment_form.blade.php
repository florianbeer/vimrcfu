@if(Auth::check())
<div class="col-sm-5 col-xs-12 pull-right comment-form">
  {{ Form::open(['route' => 'comment.store']) }}
  {{ Form::hidden('snippet_id', $snippet->id) }}
  <div class="form-group">
    @if($errors->has())
    <p class="help-block text-danger">{{ $errors->first('body') }}</p>
    @endif
    {{ Form::textarea('body', null, ['class' => 'form-control', 'rows' => '5', 'placeholder' => 'Your comment', 'tabindex' => '1', 'value' => Input::old('comment')]) }}
    <p class="help-block"><span class="small text-muted">You can use <strong>some markdown</strong> in your comment.<br>
      Italics (*), bold (**), inline code (`), code blocks without newlines (```) and blockquotes (>) are supported.</span></p>
  </div>
  <button type="submit" class="btn btn-default pull-right" tabindex="2">Submit</button>
  {{ Form::close() }}
</div>
@endif
