<!DOCTYPE html>
<html class="no-js">
  <head>
    <meta charset="utf-8">
    <title>{{ $title }} | vimrcfu</title>
    <meta name="description" content="Snippets of vimrc awesomeness.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
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
  <body>

    <div class="jumbotron" style="height: 100vh;">
      <div class="container">
        <h1 class="wow bounceInDown text-center" data-wow-duration="2s">
          <i class="fa fa-database"></i> {{ $title }}
        </h1>
        <div class="row hidden-sm hidden-xs">
          <div class="col-xs-12">
            <canvas id="canvas" width="450" height="450" class="center-block"></canvas>
          </div>
        </div>
      </div>
    </div>



    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    {{ HTML::script('js/vendor/bootstrap.min.js') }}
    {{ HTML::script('js/vendor/wow.min.js') }}
    {{ HTML::script('js/snake.js') }}
    <script>
      new WOW().init();
    </script>
    {{ HTML::script('js/main.js') }}
    <script type="text/javascript">
      var _paq = _paq || [];
      _paq.push(['trackPageView']);
      _paq.push(['enableLinkTracking']);
      (function() {
       var u=(("https:" == document.location.protocol) ? "https" : "http") + "://stats.42dev.net/";
       _paq.push(['setTrackerUrl', u+'piwik.php']);
       _paq.push(['setSiteId', 32]);
       var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0]; g.type='text/javascript';
       g.defer=true; g.async=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
       })();
    </script>
    <noscript><p><img src="http://stats.42dev.net/piwik.php?idsite=32" style="border:0;" alt="" /></p></noscript>
  </body>
</html>
