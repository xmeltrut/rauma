<?php

namespace Rauma\Test\Framework\Annotation;

use Rauma\Framework\Annotation\Route;
use PHPUnit\Framework\TestCase;
use Exception;

class RouteTest extends TestCase
{
    public function testGet()
    {
        $route = new Route([
            'value' => '/test'
        ]);
        
        $this->assertEquals('/test', $route->getPath());
        $this->assertEquals('GET', $route->getVerb());
        $this->assertEquals(['HEAD'], $route->getAdditionalVerbs());
        $this->assertEquals('get_test', $route->generateName());
        $this->assertEquals([], $route->getTokens());
    }

    public function testToken()
    {
        $route = new Route([
            'value' => '/test/{id}',
        ]);
        
        $this->assertEquals('/test/{id}', $route->getPath());
    }

    public function testRegex()
    {
        $route = new Route([
            'value' => '/test/{id:[0-9]+}',
        ]);
        
        $this->assertEquals('/test/{id}', $route->getPath());
        $this->assertEquals(['id' => '[0-9]+'], $route->getTokens());
    }
    
    public function testVerbs()
    {
        $route = new Route([
            'value' => '/test/view',
            'method' => 'POST,PUT,DELETE'
        ]);
        
        $this->assertEquals('/test/view', $route->getPath());
        $this->assertEquals('POST', $route->getVerb());
        $this->assertEquals(['PUT','DELETE'], $route->getAdditionalVerbs());
        $this->assertEquals('post_test.view', $route->generateName());
    }
    
    public function testRoot()
    {
        $route = new Route([
            'value' => '/'
        ]);
        
        $this->assertEquals('/', $route->getPath());
        $this->assertEquals('get__index', $route->generateName());
    }

    public function testNoVerbs()
    {
        $this->expectException(Exception::class);

        $route = new Route([
            'value' => '/test-route',
            'method' => 'FAKE-VERB'
        ]);
    }
}
