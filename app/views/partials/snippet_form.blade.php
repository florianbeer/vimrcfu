@if(empty($snippet->title))
      {{ Form::model($snippet, ['route' => 'snippet.store']) }}
@else
      {{ Form::model($snippet, ['route' => ['snippet.update', $snippet->id], 'method' => 'PUT']) }}
@endif
        <div class="form-group">
          <label for="Title">Snippet Title</label>
          {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter a descriptive title', 'autofocus']) }}
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <p class="help-block">Describe exactly what your snippet achieves or which behaviour it adds.</p>
          {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => '3']) }}
        </div>
        <div class="form-group">
          <label for="body">Snippet</label>
          <p class="help-block">Paste your snippet here.
          {{ Form::textarea('body', null, ['class' => 'form-control', 'rows' => '6']) }}
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      {{ Form::close() }}
