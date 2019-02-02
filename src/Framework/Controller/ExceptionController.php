<?php

namespace Rauma\Framework\Controller;

use Rauma\Messaging\Response\RedirectResponse;

/**
 * Default controller for handling application exceptions.
 */
class ExceptionController extends PageController implements ExceptionControllerInterface
{
    /**
     * Called when there is a 500 Server Error.
     *
     * @param \Throwable $exception Exception
     * @return HtmlResponse
     */
    public function error($exception)
    {
        if (getenv('app.display_errors')) {
            throw $exception;
        }

        return $this->renderPage('500.html', [], [], 500);
    }

    /**
     * Called when there is a 403 Forbidden.
     *
     * @return HtmlResponse
     */
    public function forbidden()
    {
        return $this->renderPage('403.html', [], [], 403);
    }

    /**
     * Called when there is a 404 Not Found.
     *
     * @return HtmlResponse
     */
    public function notFound()
    {
        return $this->renderPage('404.html', [], [], 404);
    }

    /**
     * Called when there is a 401 Unauathorised.
     *
     * @return RedirectResponse
     */
    public function unauthorised()
    {
        $from = sprintf(
            '%s%s%s',
            $this->getRequest()->getUri()->getPath(),
            ($this->getRequest()->getUri()->getQuery()) ? '?' : '',
            $this->getRequest()->getUri()->getQuery()
        );

        return new RedirectResponse(sprintf('/login?from=%s', urlencode($from)), 401);
    }
}
