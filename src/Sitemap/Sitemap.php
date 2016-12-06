<?php

namespace Rauma\Sitemap;

class Sitemap
{
    /**
     * @var array
     */
    private $urls;

    /**
     * Add a URL.
     *
     * @param SitemapUrl $url URL object.
     */
    public function addUrl(SitemapUrl $url)
    {
        $urls[] = $url;
    }

    /**
     * Get the URLs.
     *
     * @return array
     */
    public function getUrls()
    {
        return $this->urls;
    }
}
