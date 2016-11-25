Rauma PHP Framework
===================

A full-stack PHP framework.

Development
-----------

Run the tests via ant:

    ant

Installation
------------

Install via Composer:

    composer require xmeltrut/rauma


Bootstrap
---------

Here is the minimum set you need to get your application up-and-running.

config.yml

```yaml
routing:
    controllers:
        - "App\\Controller\\TestController"
templating:
    directory: "templates"
database:
    entityPath: "src/Entity"
```

public/index.php

```php
<?php

require '../vendor/autoload.php';

$app = new \Rauma\Framework\Core(__DIR__ . '/../');
$response = $app->run();
$response->send();
```

public/.htaccess

```
SetEnv app.display_errors 0
SetEnv app.cache.enable 0

#SetEnv app.database.user ""
#SetEnv app.database.password ""
#SetEnv app.database.name ""

Options +FollowSymLinks
RewriteEngine on
RewriteOptions MaxRedirects=10

RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^ index.php [QSA,L]
```
