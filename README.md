# vimrcfu

https://vimrcfu.com

Made with [Laravel 13](https://laravel.com/docs)

---

## Set up

* Clone the repository
* Run `composer install`
* Copy `.env.example` to `.env` and fill in the values (see below)
* Run `php artisan key:generate`
* Run `php artisan migrate`
* Don't forget to smile once in a while!

## Configuration

* Create a [GitHub OAuth application](https://github.com/settings/applications) with your Homepage URL and `<homepage>/login` as the Authorization callback URL, and put the Client ID and Client Secret in `.env`:

```dotenv
APP_URL=https://vimrcfu.com
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=vimrcfu
DB_USERNAME=vimrcfu
DB_PASSWORD=secret
GITHUB_CLIENT_ID=xxx
GITHUB_CLIENT_SECRET=xxx
```

* Search requires MySQL/MariaDB (fulltext indexes); cache, session and queue use the database by default.
* The FAQ and news boxes are rendered from `resources/markdown/faq.md` and `resources/markdown/news.md`.

## Maintainer

**vimrcfu** is currently maintained by [Florian Beer](http://github.com/florianbeer). If you have any questions please don't hesitate to get in touch.

The best way to ask questions is via GitHub [issues](https://github.com/florianbeer/vimrcfu/issues) or via Twitter [@azath0th](https://twitter.com/azath0th).

## Contributing

Please see [CONTRIBUTING](https://github.com/florianbeer/vimrcfu/blob/master/CONTRIBUTING.md) for details.

## License

<a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/"><img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-sa/4.0/88x31.png" /></a><br /><span xmlns:dct="http://purl.org/dc/terms/" property="dct:title">vimrcfu</span> by <a xmlns:cc="http://creativecommons.org/ns#" href="http://42dev.eu" property="cc:attributionName" rel="cc:attributionURL">Florian Beer | 42dev</a> is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/">Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License</a>.

Please see [LICENSE](https://github.com/florianbeer/vimrcfu/blob/master/LICENSE.md) for more details.
