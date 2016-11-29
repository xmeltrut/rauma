<?php

namespace Rauma\Test\Bootstrap;

use Rauma\Framework\Controller\PageController;

/**
 * Concrete implementation of the page controller.
 */
class ConcretePageController extends PageController
{
    public function utRender($template, array $data = [], $status = 200)
    {
        return $this->render($template, $data, $status);
    }

    public function utRenderPage($template, array $data = [], array $pageData = [], $status = 200)
    {
        return $this->renderPage($template, $data, $pageData, $status);
    }
}
