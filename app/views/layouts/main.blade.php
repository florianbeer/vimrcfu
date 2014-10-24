<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>vimrcfu - Share your best vimrc snippets</title>
        <meta name="description" content="Snippets of vimrc awesomeness.">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{ HTML::style('css/font-awesome.css')}}
        {{ HTML::style('css/bootstrap.min.css')}}
        <style>
            body {
                padding-top: 50px;
                padding-bottom: 20px;
            }
        </style>
        {{ HTML::style('css/bootstrap-social.css')}}
        {{ HTML::style('css/main.css')}}

        <!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<script>window.html5 || document.write('{{ HTML::script('js/vendor/html5shiv.js') }}')</script>
<![endif]-->
</head>
<body>
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
<div class="navbar-form navbar-right">
@if(Auth::guest())
<a href="/login" class="btn btn-social btn-github">
<i class="fa fa-github"></i> Sign in with GitHub 
</a>
@else
  <a href="/logout" class="btn btn-default">
  <i class="fa fa-sign-out"></i> Sign out
  </a>  
  @endif
  </div>
  </div><!--/.navbar-collapse -->
  </div>
  </div>

      @yield('content')

      <div class="container">
      <hr>

      <footer>
        <p class="pull-right">
          <a href="https://twitter.com/azath0th" class="twitter-follow-button" data-show-count="false">Follow @azath0th</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        </p>
        <p>&copy; 2014 <a href="http://blog.no-panic.at" target="_blank">Florian Beer</a> - made with VIM - hosted by <a href="http://42dev.eu" target="_blank">42dev</a></p>
      </footer>
      </div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        {{ HTML::script('js/vendor/bootstrap.min.js') }}
        {{ HTML::script('js/main.js') }}
    </body>
</html>
