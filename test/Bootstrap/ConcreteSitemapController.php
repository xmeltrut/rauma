<?php

namespace Rauma\Test\Bootstrap;

use Rauma\Framework\Controller\SitemapController;

/**
 * Concrete implementation of the siatemap controller.
 */
class ConcreteSitemapController extends SitemapController
{
    public function utRenderSitemap($sitemap)
    {
        return $this->renderSitemap($sitemap);
    }
}
