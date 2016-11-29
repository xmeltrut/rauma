<?php

namespace Rauma\Framework;

use Rauma\Framework\Controller\ExceptionController;
use Rauma\Service\Container;
use Exception;
use Psr\Http\Message\ServerRequestInterface;

class ErrorHandler
{
    private $di;
    private $request;

    /**
     * Constructor.
     *
     * @param \Rauma\Service\Container                 $di      Services
     * @param \Psr\Http\Message\ServerRequestInterface $request Request
     */
    public function __construct(Container $di, ServerRequestInterface $request)
    {
        $this->di = $di;
        $this->request = $request;
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
        $controller = new ExceptionController($this->di, $this->request);
        $response = $controller->error(new Exception(sprintf(
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
     * @param \Aura\Di\Container                       $di      Services
     * @param \Psr\Http\Message\ServerRequestInterface $request Request
     * @return null
     */
    public static function register($di, $request)
    {
        $errorHandler = new ErrorHandler($di, $request);
        set_error_handler([$errorHandler, 'handleError']);
    }
}
