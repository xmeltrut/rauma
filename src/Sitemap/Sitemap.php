<?php

namespace Rauma\Sitemap;

class Sitemap
{
    /**
     * @var string
     */
    private $baseUrl;

    /**
     * @var array
     */
    private $urls;

    /**
     * Constructor.
     *
     * @param string $baseUrl URI to prefix all URLs with.
     */
    public function __construct($baseUrl = '')
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * Add a URL.
     *
     * @param SitemapUrl $url URL object.
     */
    public function addUrl(SitemapUrl $url)
    {
        $this->urls[] = $url;
    }

    /**
     * Get base URL.
     *
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
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
