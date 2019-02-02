<?php

namespace Rauma\Framework;

use Rauma\Framework\Config\ConfigFactory;
use Rauma\Messaging\ServerRequestFactory;
use Rauma\Service\ContainerBuilder;
use Aura\Session\SessionFactory;

/**
 * This is the core of the framework. It runs the whole show.
 */
class Core
{
    /**
     * @var string
     */
    protected $appPath;
    
    /**
     * @var array
     */
    protected $config;
    
    /**
     * Constructor.
     *
     * @param string $rootPath Path to application.
     */
    public function __construct($rootPath)
    {
        $this->appPath = realPath($rootPath);
        $this->config = ConfigFactory::load($this->appPath . '/config.yml');
    }
    
    /**
     * Run the application itself.
     *
     * @return Response
     */
    public function run()
    {
        $di = ContainerBuilder::create($this->getConfig('services'));

        $sessionFactory = new SessionFactory;
        $session = $sessionFactory->newInstance($_COOKIE);
        $di->set('session', $session);

        $di->register(
            'templating',
            'Rauma\Templating\TemplatingFactory::create',
            [$this->appPath, $this->getConfig('templating')]
        );

        if (isset($this->config['database'])) {
            $di->register(
                'db',
                'Rauma\Database\DatabaseFactory::create',
                [$this->appPath, $this->config['database']]
            );
        }

        if (!$di->has('auth')) {
            $di->register(
                'auth',
                'Rauma\Authorisation\AuthorisationFactory::create',
                [$session]
            );
        }

        $request = ServerRequestFactory::fromGlobals();
        
        $dispatcher = new Dispatcher($this->config['routing'], $di);

        ErrorHandler::register(
            $di,
            $request,
            $dispatcher->getExceptionController()
        );

        $response = $dispatcher->dispatch($request);
        return new Response($response);
    }

    /**
     * Get a config item, if it exists.
     *
     * @param string $key Key.
     * @return array
     */
    private function getConfig($key)
    {
        if (isset($this->config[$key])) {
            return $this->config[$key];
        }

        return [];
    }
}
