<?php

namespace Rauma\Framework;

use Psr\Http\Message\ResponseInterface;

/**
 * Wraps round the PSR-7 response to provide functionality
 * to output to the client.
 */
class Response
{
    /**
     * @var ResponseInterface
     */
    protected $response;
    
    /**
     * Constructor. Takes in a PSR-7 response.
     *
     * @param ResponseInterface $response PSR-7 response object.
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }
    
    /**
     * Send the headers to the browser.
     *
     * @return void
     * @codeCoverageIgnore Cannot test headers.
     */
    public function sendHeaders()
    {
        http_response_code($this->response->getStatusCode());

        foreach ($this->response->getHeaders() as $name => $values) {
            foreach ($values as $value) {
                header(sprintf('%s: %s', $name, $value), false);
            }
        }
    }
    
    /**
     * Send the body to the browser.
     *
     * @return void
     */
    public function sendBody()
    {
        echo $this->response->getBody();
    }
    
    /**
     * Send everything to the browser.
     *
     * @return void
     * @codeCoverageIgnore Cannot test headers.
     */
    public function send()
    {
        $this->sendHeaders();
        $this->sendBody();
    }
}
