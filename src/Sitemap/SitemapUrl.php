<?php

namespace Rauma\Sitemap;

class SitemapUrl
{
    /**
     * @var string
     */
    private $location;

    /**
     * @var float
     */
    private $priority;

    /**
     * Constructor.
     *
     * @param string $location Location.
     * @param float  $priority Priority.
     */
    public function __construct($location, $priority = 0.5)
    {
        $this->location = $location;
        $this->priority = $priority;
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

    /**
     * Get priority.
     *
     * @return float
     */
    public function getPriority()
    {
        return $this->priority;
    }
}
