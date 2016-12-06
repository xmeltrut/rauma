<?php

namespace Rauma\Sitemap;

use Rauma\Framework\Annotation\Sitemap as Annotation;
use Rauma\Framework\Annotation\Exception\AnnotationException;

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
     * @param array      $tokens     Tokens.
     */
    public function __construct($location, Annotation $annotation, array $tokens = [])
    {
        $this->location = $location;
        $this->annotation = $annotation;

        if (count($tokens) > 0 && $annotation->getGenerator() === null) {
            throw new AnnotationException(
                'Sitemap URLs with tokens require a generator.'
            );
        }
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

    /**
     * Get generator.
     *
     * @return string|null
     */
    public function getGenerator()
    {
        return $this->annotation->getGenerator();
    }
}
