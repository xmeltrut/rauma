<?php

namespace Rauma\Framework\Controller;

use Rauma\Common\Collection;
use Rauma\Service\Container;
use Zend\Diactoros\Request;

/**
 * Base controller for others to extend.
 */
abstract class Controller
{
    /**
     * Dependency injection container.
     *
     * @var \Rauma\Service\Container
     */
    private $di;
    
    /**
     * PSR-7 request.
     *
     * @var \Psr\Http\Message\ServerRequestInterface
     */
    private $request;

    /**
     * POST collection.
     *
     * @var \Rauma\Common\Collection
     */
    private $postCollection;
    
    /**
     * Constructor. Assign instance variables.
     *
     * @param \Rauma\Service\Container                 $di      Dependency injection container.
     * @param \Psr\Http\Message\ServerRequestInterface $request PSR-7 request object.
     */
    public function __construct(Container $di, \Psr\Http\Message\ServerRequestInterface $request)
    {
        $this->di = $di;
        $this->request = $request;
    }
    
    /**
     * Retrieve a service from the dependency injection container.
     *
     * @param string $name Service name.
     * @return mixed
     */
    protected function service($name)
    {
        return $this->di->get($name);
    }
    
    /**
     * Get the request.
     *
     * @return Request
     */
    protected function getRequest()
    {
        return $this->request;
    }
    
    /**
     * Convience method for checking if the user is POSTing.
     *
     * @return boolean
     */
    protected function isPost()
    {
        return ($this->request->getMethod() == 'POST');
    }

    /**
     * Get POST data as a Collection.
     *
     * @return Collection
     */
    protected function getPost()
    {
        if ($this->postCollection === null) {
            $this->postCollection = new Collection($this->request->getParsedBody());
        }

        return $this->postCollection;
    }
}
