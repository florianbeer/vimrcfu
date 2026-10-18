<!DOCTYPE html>
<html class="no-js">
  <head>
    <meta charset="utf-8">
    <title>{{ $title ?? 'Be right back' }} | vimrcfu</title>
    <meta name="description" content="Snippets of vimrc awesomeness.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-social.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}?v=1.2">
    <style>
    body
    {
      height: 100vh;
      padding-top: 0px;
      padding-bottom: 0px;
    }
    .jumbotron
    {
      margin-bottom: 0px;
    }
    #canvas
    {
      margin-top: 30px;
    }
    </style>
  </head>
  <body>

    <div class="jumbotron" style="height: 100vh;">
      <div class="container">
        <h1 class="wow bounceInDown text-center" data-wow-duration="2s">
          <i class="fa fa-database"></i> {{ $title ?? 'Be right back' }}
        </h1>
        <div class="row hidden-sm hidden-xs">
          <div class="col-xs-12">
            <canvas id="canvas" width="450" height="450" class="center-block"></canvas>
          </div>
        </div>
      </div>
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/vendor/wow.min.js') }}"></script>
    <script src="{{ asset('js/snake.js') }}"></script>
    <script>
      new WOW().init();
    </script>
    <script src="{{ asset('js/main.js') }}"></script>
  </body>
</html>
