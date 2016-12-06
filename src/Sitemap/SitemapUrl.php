<?php

namespace Rauma\Sitemap;

use Rauma\Framework\Annotation\Sitemap as Annotation;

class SitemapUrl
{
    /**
     * @var string
     */
    private $location;

    /**
     * @var Annotation
     */
    private $annotation;

    /**
     * Constructor.
     *
     * @param string     $location   Location.
     * @param Annotation $annotation Annotation.
     */
    public function __construct($location, Annotation $annotation)
    {
        $this->location = $location;
        $this->annotation = $annotation;
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
     * Get change frequency.
     *
     * @return string|null
     */
    public function getChangeFreq()
    {
        return $this->annotation->getChangeFreq();
    }

    /**
     * Get priority.
     *
     * @return float
     */
    public function getPriority()
    {
        return $this->annotation->getPriority();
    }
}
