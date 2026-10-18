<h2>Search</h2>
<form method="GET" action="{{ route('search') }}">
  <div class="form-group">
    <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Search" tabindex="1">
  </div>
</form>
