Sitemaps
========

You get a sitemap out-of-the-box by including the `SitemapController` in your config.

```yaml
routing:
    controllers:
        - "Rauma\\Framework\\Controller\\SitemapController"
```

Then use the `Sitemap` annotation on the routes you want to include.

```php
use Rauma\Framework\Annotation\Sitemap;

class ExampleController
{
    /**
     * @Route("/example")
     * @Sitemap
     */
    public function example()
    {
        return $this->renderPage('example.html');
    }
}
```

There is no support for dynamic URLs.
