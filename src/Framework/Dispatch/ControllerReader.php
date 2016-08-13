<?php

namespace Rauma\Framework\Dispatch;

use Doctrine\Common\Annotations\Reader;

/**
 * Read the annotations on a controller.
 */
class ControllerReader
{
    protected $reader;
    protected $reflClass;
    protected $baseInfo;

    /**
     * Constructor.
     *
     * @param Reader $reader    Annotations reader
     * @param string $className Class name
     */
    public function __construct(Reader $reader, $className)
    {
        $this->reader = $reader;
        $this->reflClass = new \ReflectionClass($className);
        $this->setupBaseInfo();
    }

    /**
     * Read annotations from the class.
     */
    protected function setupBaseInfo()
    {
        $routeInfo = ['auth' => []];

        foreach ($this->reader->getClassAnnotations($this->reflClass) as $annotation) {
            if ($annotation instanceof \Rauma\Framework\Annotation\LoggedIn) {
                $routeInfo['auth']['required'] = true;
            }

            if ($annotation instanceof \Rauma\Framework\Annotation\Allowed) {
                $routeInfo['auth']['required'] = true;
                $routeInfo['auth']['allowed'] = $annotation->getRoles();
            }
        }

        $this->baseInfo = $routeInfo;
    }

    /**
     * Read each method.
     *
     * @return array
     */
    public function readRoutes()
    {
        $routes = [];

        foreach ($this->reflClass->getMethods() as $method) {
            $routeInfo = $this->baseInfo;

            foreach ($this->reader->getMethodAnnotations($method) as $annotation) {
                if ($annotation instanceof \Rauma\Framework\Annotation\Route) {
                    $routeInfo['controller'] = $this->reflClass->getName();
                    $routeInfo['method'] = $method->getName();
                    $routeInfo['verb'] = $annotation->getVerb();
                    $routeInfo['name'] = $annotation->generateName();
                    $routeInfo['path'] = $annotation->getPath();
                    $routeInfo['additionalVerbs'] = $annotation->getAdditionalVerbs();
                    $routeInfo['tokens'] = $annotation->getTokens();
                }

                if ($annotation instanceof \Rauma\Framework\Annotation\LoggedIn) {
                    $routeInfo['auth']['required'] = true;
                }

                if ($annotation instanceof \Rauma\Framework\Annotation\Allowed) {
                    $routeInfo['auth']['required'] = true;

                    if (isset($routeInfo['auth']['allowed'])) {
                        $routeInfo['auth']['allowed'] = array_unique(array_merge(
                            $routeInfo['auth']['allowed'],
                            $annotation->getRoles()
                        ));
                    } else {
                        $routeInfo['auth']['allowed'] = $annotation->getRoles();
                    }
                }
            }

            if (isset($routeInfo['verb'])) {
                $routes[] = $routeInfo;
            }
        }

        return $routes;
    }
}
