<div class="col-xs-12 clearfix">
  <div class="pull-right">
    {{ $snippets->appends(['q' => Input::get('q')])->links() }}
  </div>
</div>
