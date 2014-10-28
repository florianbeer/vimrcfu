<!DOCTYPE html>
<html class="no-js">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>@yield('title') | vimrcfu</title>
    <meta name="description" content="Snippets of vimrc awesomeness.">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{ HTML::style('css/font-awesome.css') }}
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/bootstrap-social.css') }}
    {{ HTML::style('css/animate.min.css') }}
    {{ HTML::style('css/main.css?v=1.1') }}
    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <script>window.html5 || document.write('{{ HTML::script('js/vendor/html5shiv.js') }}')</script>
    <![endif]-->
  </head>
  <body>
    @include('partials.navbar')

    @yield('content')

    <div class="container">
      <hr>
      <footer>
        <p class="pull-right">
        <a href="https://twitter.com/azath0th" class="twitter-follow-button" data-show-count="false">Follow @azath0th</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        </p>
        <p>&copy; 2014 <a href="http://blog.no-panic.at" target="_blank">Florian Beer</a> - made with Vim - hosted by <a href="http://42dev.eu" target="_blank">42dev</a></p>
      </footer>
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    {{ HTML::script('js/vendor/bootstrap.min.js') }}
    {{ HTML::script('js/vendor/wow.min.js') }}
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
