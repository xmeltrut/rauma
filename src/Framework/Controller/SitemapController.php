<?php

/**
 * @todo Add unit test
 * @todo Return xml content header
 */

namespace Rauma\Framework\Controller;

use Zend\Diactoros\Response;

/**
 * Out-of-the-box sitemap functionality.
 */
class SitemapController extends Controller
{
    /**
     * @Route("/sitemap.xml")
     */
    public function sitemap()
    {
        $xml = $this->service('templating')->render(
            __DIR__ . '/../../../templates/sitemap.xml',
            $this->service('sitemap')
        );

        return new Response($xml);
    }
}
