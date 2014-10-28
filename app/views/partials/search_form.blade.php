<div class="col-sm-4 col-xs-12">
    <h2>Search</h2>
    {{ Form::open(['route' => 'search', 'method' => 'get']) }}
    <div class="form-group">
      {{ Form::text('q', Input::get('q'), ['class' => 'form-control', 'placeholder' => 'Search', 'tabindex' => '1']) }}
    </div>
    {{ Form::close() }}
</div>
