<?php

/**
 * @todo Add unit test
 * @todo Take template from standard location
 */

namespace Rauma\Framework\Controller;

use Rauma\Framework\Annotation\Route;
use Zend\Diactoros\Response\TextResponse;

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
        /*$xml = $this->service('templating')->render(
            __DIR__ . '/../../../templates/sitemap.xml',
            ['sitemap' => $this->service('sitemap')]
        );*/

        $xml = $this->service('templating')->render(
            'sitemap.xml',
            ['sitemap' => $this->service('sitemap')]
        );

        return new TextResponse($xml, 200, [
            'Content-Type' => 'application/xml; charset=utf-8'
        ]);
    }
}
