Sitemaps
========

Rauma ships with everything you need to render sitemaps. All you need to do is extend the base SitemapController class and fill in the details of the URLs you would like to include.

```php
<?php

namespace App\Controller;

use Rauma\Framework\Annotation\Route;
use Rauma\Framework\Controller\SitemapController as BaseSitemapController;
use Rauma\Sitemap\Sitemap;
use Rauma\Sitemap\SitemapUrl;

class SitemapController extends BaseSitemapController
{
    /**
     * @Route("/sitemap.xml")
     */
    public function sitemap()
    {
        $sitemap = new Sitemap('https://www.your-domain.com');
        $sitemap->addUrl(new SitemapUrl('/test', 0.7));

        return $this->renderSitemap($sitemap);
    }
}

```

Specifying a base URL when creating the `Sitemap` object is optional, as is specifying the priority when creating a `SitemapUrl`.
