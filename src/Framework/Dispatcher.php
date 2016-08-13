<?php

namespace Rauma\Framework;

use Rauma\Authorisation\Exception\ForbiddenException;
use Rauma\Authorisation\Exception\UnauthorisedException;
use Rauma\Framework\Controller\ExceptionController;
use Rauma\Framework\Exception\NotFoundException;
use Aura\Router\RouterContainer;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\IndexedReader;
use Doctrine\Common\Cache\ApcCache;

/**
 * Handles the dispatch of a request to a controller.
 */
class Dispatcher
{
    /**
     * @var array
     */
    protected $config;
    
    /**
     * @var \Aura\Di\Container
     */
    protected $di;
    
    /**
     * @var \Aura\Router\Router
     */
    protected $router;
    
    /**
     * Constructor. Load the routes in.
     *
     * @param array              $config Config for routing.
     * @param \Aura\Di\Container $di     Dependency injection container.
     */
    public function __construct(array $config, \Aura\Di\Container $di)
    {
        $this->config = $config;
        $this->di = $di;
        $this->router = $this->loadRoutes();
    }
    
    /**
     * Dispatch a request.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request Request.
     * @return string
     */
    public function dispatch(\Psr\Http\Message\ServerRequestInterface $request)
    {
        $matcher = $this->router->getMatcher();
        $route = $matcher->match($request);
        
        try {
            if (!$route) {
                throw new NotFoundException;
            }

            $this->di->get('auth')->validateRoute($route->handler['auth']);
            $controllerName = $route->handler['controller'];
            $methodName = $route->handler['method'];
            $controller = new $controllerName($this->di, $request);
            $response = call_user_func_array([$controller, $methodName], $route->attributes);
        } catch (NotFoundException $e) {
            $controller = new ExceptionController($this->di, $request);
            $response = $controller->notFound();
        } catch (UnauthorisedException $e) {
            $controller = new ExceptionController($this->di, $request);
            $response = $controller->unauthorised();
        } catch (ForbiddenException $e) {
            $controller = new ExceptionController($this->di, $request);
            $response = $controller->forbidden();
        } catch (\Exception $e) {
            $controller = new ExceptionController($this->di, $request);
            $response = $controller->error($e);
        }
        
        return $response;
    }
    
    /**
     * Parse the annotations for routes and load them in.
     *
     * @return RouterContainer
     */
    protected function loadRoutes()
    {
        AnnotationRegistry::registerFile(__DIR__ .'/Annotation/Allowed.php');
        AnnotationRegistry::registerFile(__DIR__ .'/Annotation/LoggedIn.php');
        AnnotationRegistry::registerFile(__DIR__ .'/Annotation/Route.php');

        $router = new RouterContainer();
        $reader = new IndexedReader(
            new AnnotationReader,
            new ApcCache,
            (!getenv('app.cache.enable'))
        );
        $map = $router->getMap();

        foreach ($this->config['controllers'] as $controllerName) {
            $controller = new Dispatch\ControllerReader($reader, $controllerName);

            foreach ($controller->readRoutes() as $routeInfo) {
                $verb = $routeInfo['verb'];
                $route = $map->$verb($routeInfo['name'], $routeInfo['path'], [
                    'controller' => $routeInfo['controller'],
                    'method' => $routeInfo['method'],
                    'auth' => $routeInfo['auth']
                ])->tokens($routeInfo['tokens']);

                if ($routeInfo['additionalVerbs']) {
                    $route->allows($routeInfo['additionalVerbs']);
                }
            }
        }

        return $router;
    }
}
