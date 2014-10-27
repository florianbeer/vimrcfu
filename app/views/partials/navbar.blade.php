<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/"><tt>vimrcfu</tt></a>
    </div>
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li><a href="{{ URL::route('snippet.create') }}"><i class="fa fa-plus"></i> New snippet</a></li>
        <li><a href="{{ URL::route('snippet.index') }}"><i class="fa fa-code"></i> Browse snippets</a></li>
      </ul>
      @if(Auth::guest())
      <div class="navbar-form navbar-right">
        <a href="/login" class="btn btn-social btn-github"><i class="fa fa-github"></i> Sign in with GitHub </a>
      </div>
      @else
      <ul class="nav navbar-nav navbar-right">
        <li><a href="{{ URL::route('user.show', Auth::user()->id) }}"><i class="fa fa-user"></i> {{ Auth::user()->name }}</a></li>
        <li><a href="/logout"><i class="fa fa-sign-out"></i> Sign out</a></ul> 
      </ul>
      @endif
    </div>
  </div>
</div>
