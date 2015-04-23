<script type="text/javascript">
  var _paq = _paq || [];
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
      var u="{{ getenv('PIWIK_URL') }}"
      _paq.push(['setTrackerUrl', u+'piwik.php']);
      _paq.push(['setSiteId', {{ getenv('PIWIK_ID') }}]);
      @if(Auth::check())
        _paq.push(['setUserId', "{{ Auth::user()->name }}"]);
      @endif
      var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
      g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
    })();
</script>
<noscript><p><img src="//stats.42dev.net/piwik.php?idsite=32" style="border:0;" alt="" /></p></noscript>
