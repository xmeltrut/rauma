<?php

namespace Rauma\Templating;

/**
 * Represents all the meta tags for a page.
 */
class Meta
{
    /**
     * @var string
     */
    protected $title;
    
    /**
     * @var string
     */
    protected $description;
    
    /**
     * @var array
     */
    protected $keywords = [];

    /**
     * @var string
     */
    protected $canonicalUrl;

    /**
     * @var string
     */
    protected $ogTitle;

    /**
     * @var string
     */
    protected $ogImage;
    
    /**
     * Retrieve the title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * Set the title.
     *
     * @param string  $value   Title.
     * @param boolean $replace Replace existing title, rather than affix.
     * @return void
     */
    public function setTitle($value, $replace = false)
    {
        if ($replace === false && $this->title) {
            $this->title = sprintf('%s - %s', $value, $this->title);
        } else {
            $this->title = $value;
        }
    }
    
    /**
     * Retrieve the description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    /**
     * Set the description.
     *
     * @param string $value Description.
     * @return void
     */
    public function setDescription($value)
    {
        $this->description = $value;
    }
    
    /**
     * Get a list of keywords as a string.
     *
     * @return string
     */
    public function getKeywords()
    {
        return implode(',', $this->keywords);
    }
    
    /**
     * Add an array of keywords.
     *
     * @param array $keywords Keywords to add.
     * @return void
     */
    public function addKeywords(array $keywords)
    {
        foreach ($keywords as $keyword) {
            $this->keywords[] = $keyword;
        }
    }

    /**
     * Get the canonical URL.
     *
     * @return string
     */
    public function getCanonicalUrl()
    {
        return $this->canonicalUrl;
    }

    /**
     * Set the canonical URL.
     *
     * @param string $value URL.
     * @return void
     */
    public function setCanonicalUrl($value)
    {
        $this->canonicalUrl = $value;
    }

    /**
     * Get the OpenGraph title.
     *
     * @return string
     */
    public function getOgTitle()
    {
        return $this->ogTitle;
    }

    /**
     * Set OpenGraph title.
     *
     * @param string $value Title.
     * @return void
     */
    public function setOgTitle($value)
    {
        $this->ogTitle = $value;
    }

    /**
     * Get the OpenGraph image.
     *
     * @return string
     */
    public function getOgImage()
    {
        return $this->ogImage;
    }

    /**
     * Set OpenGraph image.
     *
     * @param string $value Image.
     * @return void
     */
    public function setOgImage($value)
    {
        $this->ogImage = $value;
    }
}
