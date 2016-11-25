Controllers
===========

Controllers should extend `Rauma\Framework\Controller\Controller` and be listed in the applications `config.yml`. If you are rending HTML pages, extend `PageController` instead to get a bunch of stuff for free, such as template rendering.

```php
<?php

namespace App\Controller;

use Rauma\Framework\Annotation\Route;
use Rauma\Framework\Controller\PageController;

class TestController extends PageController
{
    /**
     * @Route("/")
     */
    public function index()
    {
        return $this->renderPage('homepage.html');
    }
}
```

Routes
------

Routes are added using annotations. You can add dynamic sections, with an optional regular expression to validate them.

```
@Route("/some-url/{year:[0-0]+}/{slug}")
```

You can also specify methods allowed. If the method attribute is not specified, it defaults to `get`. Any time you add a `get`, a `head` is also added.

```
@Route("/url", method="GET,POST")
```

Annotation performance
----------------------

For faster performance, enable APC usage. This will cache the reading of annotations.

```
SetEnv app.cache.enable 1
```
