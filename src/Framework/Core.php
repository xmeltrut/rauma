<?php

namespace Rauma\Framework;

use Rauma\Authorisation\AuthorisationFactory;
use Rauma\Database\DatabaseFactory;
use Rauma\Framework\Config\ConfigFactory;
use Rauma\Messaging\ServerRequestFactory;
use Rauma\Templating\TemplatingFactory;
use Aura\Di\ContainerBuilder;
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
        $builder = new ContainerBuilder();
        $sessionFactory = new SessionFactory;
        $session = $sessionFactory->newInstance($_COOKIE);

        $di = $builder->newInstance();
        $di->set('templating', TemplatingFactory::create(
            $this->appPath,
            isset($this->config['templating']) ? $this->config['templating'] : []
        ));
        $di->set('session', $session);
        $di->set('auth', AuthorisationFactory::create($session));

        if (isset($this->config['database'])) {
            $di->set('db', DatabaseFactory::create(
                $this->appPath,
                $this->config['database']
            ));
        }

        $request = ServerRequestFactory::fromGlobals();
        
        $dispatcher = new Dispatcher($this->config['routing'], $di);

        ErrorHandler::register($di, $request);

        $response = $dispatcher->dispatch($request);
        return new Response($response);
    }
}
