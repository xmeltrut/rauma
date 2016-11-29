Services
========

Services are classes that provide global functionality throughout the application. They are registered with the service container and can be accessed from inside controllers.

```php
$this->service('templating')->render();
```

Registering services
--------------------

You can register your own custom services in `config.yml`.

```yaml
services:
    example: "App\\Service\\Example"
```

You can also use factories to create the object.

```yaml
services:
    example: "App\\Service\\ExampleFactory::create"
```

Parameters
----------

If you need to pass arguments in, you can do so.

```yaml
services:
    example:
        class: "App\\Service\\Example"
        params: ["param-1", "param-2"]
```

If you need to inject another service as a dependency, you can do that too, by wrapping the service name in percentage signs.

```yaml
services:
    example:
        class: "App\\Service\\Example"
        params: ["%db%"]
```
