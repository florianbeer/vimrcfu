<!DOCTYPE html>
<html class="no-js">
  <head>
    <meta charset="utf-8">
    <title>@yield('title') | vimrcfu</title>
    <meta name="description" content="Snippets of vimrc awesomeness.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-social.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}?v=1.3">
    <link href="{{ config('app.url') }}/feed" rel="alternate" type="application/rss+xml" title="vimrcfu - Share your best vimrc snippets.">
  </head>
  <body>
    @include('partials.navbar')

    @yield('content')

    <div class="container">
      <hr>
      <footer class="small text-muted">
        <div class="row">
          <p class="col-sm-6 col-xs-12">
            &copy; {{ date('Y') }} <a href="http://blog.no-panic.at" target="_blank">Florian Beer</a> - made with Vim<br>
            Source code on <a href="https://github.com/florianbeer/vimrcfu">GitHub</a><br>
            Hosted by <a href="http://42dev.eu" target="_blank">42dev</a>
          </p>
          <p class="col-sm-6 col-xs-12 footer-social">
            Find me on<br>
            <a href="https://x.com/azath0th" target="_blank" rel="me noopener">X @azath0th</a><br>
            <a href="https://dev-null.sh/@florianbeer" target="_blank" rel="me noopener">/dev/null @florianbeer</a>
          </p>
        </div>
      </footer>
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/vendor/wow.min.js') }}"></script>
    <script>
      new WOW().init();
    </script>
    <script src="{{ asset('js/main.js') }}"></script>
    @yield('script')
  </body>
</html>
