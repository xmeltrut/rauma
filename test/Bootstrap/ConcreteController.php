<?php

namespace Rauma\Test\Bootstrap;

use Rauma\Framework\Controller\Controller;

/**
 * Concrete implementation of the controller.
 */
class ConcreteController extends Controller
{
    /**
     * Exposes the service method.
     *
     * @param string $key Key.
     * @return mixed
     */
    public function utService($key)
    {
        return $this->service($key);
    }

    /**
     * Exposes the getRequest method.
     *
     * @return object
     */
    public function utGetRequest()
    {
        return $this->getRequest();
    }

    /**
     * Exposes isPost method.
     *
     * @return boolean
     */
    public function utIsPost()
    {
        return $this->isPost();
    }

    /**
     * Exposes getPost method.
     *
     * @return Collection
     */
    public function utGetPost()
    {
        return $this->getPost();
    }
}
