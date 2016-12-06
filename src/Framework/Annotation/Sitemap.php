<?php

namespace Rauma\Framework\Annotation;

/**
 * Include this page in the sitemap.
 *
 * @Annotation
 * @Target({"METHOD"})
 */
class Sitemap
{
    /**
     * @var array
     */
    private $values;

    /**
     * @var array
     */
    private $allowedChangeFreqs = [
        'always'
        'hourly'
        'daily'
        'weekly'
        'monthly'
        'yearly'
        'never'
    ];

    /**
     * Constructor.
     *
     * @param array $values Annotation properties.
     */
    public function __construct(array $values = [])
    {
        $this->values = $values;
    }

    /**
     * Get change frequency.
     *
     * @return string|null
     */
    public function getChangeFreq()
    {
        if (isset($this->values['changefreq'])) {
            if (!in_array(
                $this->values['changefreq'],
                $this->allowedChangeFreqs
            )) {
                throw new Exception\AnnotationException(sprintf(
                    'Invalid change frequency: %s',
                    $this->values['changefreq']
                ));
            }

            return $this->values['changefreq'];
        }

        return null;
    }
}
