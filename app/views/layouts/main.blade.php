<!DOCTYPE html>
<html class="no-js">
  <head>
    <meta charset="utf-8">
    <title>@yield('title') | vimrcfu</title>
    <meta name="description" content="Snippets of vimrc awesomeness.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    {{ HTML::style('css/font-awesome.css') }}
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/bootstrap-social.css') }}
    {{ HTML::style('css/animate.min.css') }}
    {{ HTML::style('css/main.css?v=1.2') }}
    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <script>window.html5 || document.write('{{ HTML::script('js/vendor/html5shiv.js') }}')</script>
    <![endif]-->
    <link href="{{ Config::get('app.url') }}/feed" rel="alternate" type="application/rss+xml" title="vimrcfu - Share your best vimrc snippets.">
  </head>
  <body>
    @include('partials.navbar')

    @yield('content')

    <div class="container">
      <hr>
      <footer class="small text-muted">
        <div class="row">
          <p class="col-sm-6 col-xs-12">
            &copy; {{ date('Y')  }} <a href="http://blog.no-panic.at" target="_blank">Florian Beer</a> - made with Vim<br>
            Source code on <a href="https://github.com/florianbeer/vimrcfu">GitHub</a><br>
            Hosted by <a href="http://42dev.eu" target="_blank">42dev</a>
          </p>
          <p class="col-sm-6 col-xs-12">
            <a href="https://twitter.com/azath0th" class="twitter-follow-button pull-right" data-show-count="false">Follow @azath0th</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
          </p>
        </div>
      </footer>
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    {{ HTML::script('js/vendor/bootstrap.min.js') }}
    {{ HTML::script('js/vendor/wow.min.js') }}
    <script>
      new WOW().init();
    </script>
    {{ HTML::script('js/main.js') }}
    @yield('script')
    @if(getenv('PIWIK_URL'))
      @include('partials.tracking')
    @endif
  </body>
</html>
