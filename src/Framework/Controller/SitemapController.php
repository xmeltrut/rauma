<?php

namespace Rauma\Framework\Controller;

use Rauma\Framework\Annotation\Route;
use Rauma\Sitemap\Sitemap;
use Zend\Diactoros\Response\TextResponse;

/**
 * Provide helpers to render sitemaps.
 */
class SitemapController extends Controller
{
    /**
     * Render a sitemap.
     *
     * @param Sitemap $sitemap Sitemap to render.
     * @return TextResponse
     */
    protected function renderSitemap(Sitemap $sitemap)
    {
        $xml = $this->service('templating')->render(
            'sitemap.xml',
            [
                'sitemap' => $sitemap
            ]
        );

        return new TextResponse($xml, 200, [
            'Content-Type' => 'application/xml; charset=utf-8'
        ]);
    }
}
