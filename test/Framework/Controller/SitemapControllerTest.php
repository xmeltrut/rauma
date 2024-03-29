<?php

namespace Rauma\Test\Framework\Controller;

use Rauma\Test\Bootstrap\ConcreteSitemapController;
use PHPUnit\Framework\TestCase;

class SitemapControllerTest extends TestCase
{
    public function testRenderSitemap()
    {
        // create a mock sitemap
        $sitemap = $this->createMock('Rauma\Sitemap\Sitemap');

        // create mock controller objects
        $di = $this->createMock('Rauma\Service\Container');
        $request = $this->createMock('Psr\Http\Message\ServerRequestInterface');

        // attach a mock templating object
        $templating = $this->getMockBuilder('Rauma\Templating\Templating')
                           ->disableOriginalConstructor()
                           ->getMock();

        $templating->expects($this->once())
                   ->method('render')
                   ->with('sitemap.xml', ['sitemap' => $sitemap])
                   ->willReturn('sitemap-xml');

        $di->method('get')
           ->with('templating')
           ->willReturn($templating);

        // create controller
        $controller = new ConcreteSitemapController($di, $request);

        // run render sitemap method
        $response = $controller->utRenderSitemap($sitemap);

        // validate result
        $this->assertInstanceOf('Laminas\Diactoros\Response\TextResponse', $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('sitemap-xml', $response->getBody());
    }
}
