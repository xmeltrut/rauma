Error handling
==============

When an error is thrown, Rauma will handle it and search for a default template. Therefore, you want the following templates in your templates directory:

* 403.html (forbidden)
* 404.html (not found)
* 500.html (internal server error)

These pages will be rendered standalone, without any layout wrapper.

Templateless configuration
--------------------------

If the required template does not exist, Rauma will serve some simple default HTML files.

Error reporting
---------------

Rauma consults an environmental variable named `app.display_errors`. If an exception is thrown, and this is set to 1, it will re-throw the error so you can see it. If not, the error is supressed and the standard errorp age is shown.

You can see this in Apache using the following directive:

    SetEnv app.display_errors 1

Custom error handling
---------------------

You can configure your own exception handling class in `config.yml`.

```yaml
routing:
    exceptionController: "App\\Controller\\ExceptionController"
```

This class needs to implement `ExceptionControllerInterface`. If the class cannot be found, or does not implement the exception interface, it will silently fall back to the in-built error handling.

```php
<?php

namespace App\Controller;

use Rauma\Framework\Controller\PageController;
use Rauma\Framework\Controller\ExceptionControllerInterface;
use Exception;
use Zend\Diactoros\Response\HtmlResponse;

class ExceptionController extends PageController implements ExceptionControllerInterface
{
    public function error(Exception $exception)
    {
        return new HtmlResponse('Error', 500);
    }

    public function forbidden()
    {
        return new HtmlResponse('Forbidden', 403);
    }

    public function notFound()
    {
        return new HtmlResponse('Not found', 404);
    }

    public function unauthorised()
    {
        return new HtmlResponse('Unauthorised', 401);
    }
}
```

You do not need to list the exception controller in your mail list of controllers.
