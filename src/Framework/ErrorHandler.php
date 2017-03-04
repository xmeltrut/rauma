<?php

namespace Rauma\Framework;

use Rauma\Framework\Controller\ExceptionControllerInterface;
use Rauma\Service\Container;
use Exception;
use Psr\Http\Message\ServerRequestInterface;

class ErrorHandler
{
    private $di;
    private $request;
    private $controller;

    /**
     * Constructor.
     *
     * @param \Rauma\Service\Container                 $di         Services
     * @param \Psr\Http\Message\ServerRequestInterface $request    Request
     * @param ExceptionControllerInterface             $controller Controller.
     */
    public function __construct(Container $di, ServerRequestInterface $request, ExceptionControllerInterface $controller)
    {
        $this->di = $di;
        $this->request = $request;
        $this->controller = $controller;
    }

    /**
     * Handle an error.
     *
     * @param integer $num    Error number
     * @param string  $string Error string
     * @param string  $file   Filename
     * @param integer $line   Line number
     * @return null
     * @codeCoverageIgnore Cannot test dies.
     */
    public function handleError($num, $string, $file, $line)
    {
        $response = $this->controller->error(new Exception(sprintf(
            'PHP error: %s (%s), in %s:%s',
            $string,
            $num,
            $file,
            $line
        )));
        $output = new Response($response);
        $output->send();
        die;
    }

    /**
     * Register the error handler.
     *
     * @param Container                    $di         Services.
     * @param ServerRequestInterface       $request    Request.
     * @param ExceptionControllerInterface $controller Controller.
     * @return null
     */
    public static function register($di, $request, ExceptionControllerInterface $controller)
    {
        $errorHandler = new ErrorHandler($di, $request, $controller);
        set_error_handler([$errorHandler, 'handleError']);
    }
}
