<?php

namespace Rauma\Framework\Controller;

use Rauma\Templating\Meta;
use Zend\Diactoros\Response\HtmlResponse;

/**
 * Child class of Controller. This adds additional functionality
 * if you are serving web pages and want functionality like layouts.
 */
class PageController extends Controller
{
    /**
     * Layout template for rendering pages.
     *
     * @var string
     */
    protected $layout = 'layout.html';

    /**
     * Meta information for the page.
     *
     * @var \Rauma\Templating\Meta
     */
    protected $meta;

    /**
     * Constructor. Assign instance variables.
     *
     * @param \Aura\Di\Container                       $di      Dependency injection container.
     * @param \Psr\Http\Message\ServerRequestInterface $request PSR-7 request object.
     */
    public function __construct(\Aura\Di\Container $di, \Psr\Http\Message\ServerRequestInterface $request)
    {
        parent::__construct($di, $request);
        
        $this->meta = new Meta;
    }

    /**
     * Render a template without a wrapper.
     *
     * @param string  $template Template file.
     * @param array   $data     Template data.
     * @param integer $status   Status code.
     * @return \Zend\Diactoros\Response\HtmlResponse
     */
    public function render($template, array $data = [], $status = 200)
    {
        $page = $this->service('templating')->render($template, $data);
        return new HtmlResponse($page, $status);
    }

    /**
     * Render a template and put into a page wrapper.
     *
     * @param string  $template Template file.
     * @param array   $data     Template data.
     * @param array   $pageData Data to be included in page rendering.
     * @param integer $status   Status code.
     * @return \Zend\Diactoros\Response\HtmlResponse
     */
    protected function renderPage($template, array $data = [], array $pageData = [], $status = 200)
    {
        $body = $this->service('templating')->render($template, $data);
        
        $page = $this->service('templating')->render($this->layout, array_merge($pageData, [
            'body' => $body,
            'meta' => $this->meta
        ]));
        
        return new HtmlResponse($page, $status);
    }
}
