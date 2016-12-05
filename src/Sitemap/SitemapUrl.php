<?php

namespace Rauma\Sitemap;

class SitemapUrl
{
    /**
     * @var string
     */
    private $location;

    /**
     * Constructor.
     *
     * @param string $location Location.
     */
    public function __construct($location)
    {
        $this->location = $location;
    }

    /**
     * Get the location.
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }
}
