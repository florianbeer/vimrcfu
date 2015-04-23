# vimrcfu

http://vimrcfu.com

Made with [Laravel 4.2](http://laravel.com/docs/4.2)

---

## Set up

* Clone the repository into a directory on your local machine (development) or server (production)
* Follow the [configuration](#Configuration) steps below
* **vimrcfu** uses Memcache for caching. If you don't want to install Memcache, set driver to `file` in `app/config/cache.php`.
* Run `composer install`
* Run `php artisan migrate`
* Don't forget to smile once in a while!


## <a name="#configuration"></a>Configuration

### For development

* Create a [GitHub application](https://github.com/settings/applications), for example "vimrcfu dev", with your local Homepage URL and Authorization callback URL (e.g. `http://vimrcfu.loc` and `http://vimrcfu.loc/login`) and note the Client ID and Client Secret GitHub generates for your.
* Create the file `.env.local.php` in the directory where you cloned the repository with the following content:

``` php
return [
  'DB_HOST'       => 'localhost', # Fill in your database host
  'DB_NAME'       => 'vimrcfu',   # Fill in your database name
  'DB_USER'       => 'root',      # Fill in your database username
  'DB_PASSWORD'   => '',          # Fill in your database password
  'APP_KEY'       => '',          # Choose a very random string with at least 32 characters
  'GITHUB_CLIENT' => '',          # Fill in your GitHub Client ID
  'GITHUB_SECRET' => '',          # Fill in your GitHub Client Secret
  'PIWIK_URL'     => '',          # Fill in URL if you want Piwik tracking
  'PIWIK_ID'      => '',          # Piwik site id
   ];
```

### For production

* In your webserver set an environment variable called `APP_ENV` and give it a value of `production`.

  * For Apache put the following in your vhost configuration: `SetEnv APP_ENV production`
  * For nginx if you use php-fpm put the following in your location block: `fastcgi_param   APP_ENV  production;`


* Create the file `.env.php` in the directory where you cloned the repository with the same contents as above, but fill in your production database settings, Client ID and Client Secret (create a new application on GitHub with the actual Homepage URL and Authorization callback URL for your production domain).

## Maintainer

**vimrcfu** is currently maintained by [Florian Beer](http://github.com/florianbeer). If you have any questions please don't hesitate to get in touch.

The best way to ask questions is via GitHub [issues](https://github.com/florianbeer/vimrcfu/issues) or via Twitter [@azath0th](https://twitter.com/azath0th).

## Contributing

Please see [CONTRIBUTING](https://github.com/florianbeer/vimrcfu/blob/master/CONTRIBUTING.md) for details.

## License

<a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/"><img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-sa/4.0/88x31.png" /></a><br /><span xmlns:dct="http://purl.org/dc/terms/" property="dct:title">vimrcfu</span> by <a xmlns:cc="http://creativecommons.org/ns#" href="http://42dev.eu" property="cc:attributionName" rel="cc:attributionURL">Florian Beer | 42dev</a> is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/">Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License</a>.

Please see [LICENSE](https://github.com/florianbeer/vimrcfu/blob/master/LICENSE.md) for more details.

