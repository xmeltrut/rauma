Getting started
===============

This details how to get up-and-running.

Installation
------------

Install via Composer.

    composer require xmeltrut/rauma

You will also want to configure the autoloading to load your application.

```json
"autoload": {
    "psr-4": {
        "App\\": "src/"
    }
}
```

Bootstrapping
-------------

There are two essential files that Rauma requires The first is a config file that should be named `config.yml` and placed in your root directory.

```yaml
routing:
    controllers:
        - "App\\Controller\\ExampleController"
```

The second is a default PHP file, typically called `index.php`, that should be placed in your public directory.

```php
<?php

require '../vendor/autoload.php';

$app = new \Rauma\Framework\Core(__DIR__ . '/../');
$response = $app->run();
$response->send();
```

Apache configuration
--------------------

Create a virtual host that points at a directory called `public` inside your root directory.

```
<VirtualHost *:80>
    ServerName raumatest
    DirectoryIndex index.php
    DocumentRoot "/opt/docroot/raumatest/public"
</VirtualHost>
```

Configure `mod_rewrite` to route requests to your entry point.

```
Options +FollowSymLinks
RewriteEngine on
RewriteOptions MaxRedirects=10

RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^ index.php [QSA,L]
```
