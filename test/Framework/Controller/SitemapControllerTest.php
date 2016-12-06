<?php

namespace Rauma\Test\Framework\Controller;

use Rauma\Framework\Controller\SitemapController;

class SitemapControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testSitemap()
    {
        $request = $this->getMock('Psr\Http\Message\ServerRequestInterface');
        $di = $this->getMock('Rauma\Service\Container');

        $controller = new SitemapController($this->di, $this->request);

        $templating = $this->getMockBuilder('Rauma\Templating\Templating')
                           ->disableOriginalConstructor()
                           ->getMock();
        $templating->expects($this->once())
                   ->method('render')
                   ->with('sitemap.xml', ['sitemap' => 'test-sitemap'])
                   ->wilLReturn('xml');

        $di->method('get')
           ->with('templating')
           ->willReturn($this->templating);

        $di->method('get')
           ->expects($this->once())
           ->willReturn('test-sitemap');

        $response = $controller->sitemap();

        $this->assertEquals('xml', $response->getBody());
        $this->assertEquals(
            'application/xml; charset=utf-8',
            $response->getHeader('Content-Type')
        );
    }
}
