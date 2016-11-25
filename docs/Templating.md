Templating
==========

Rauma uses the Mustache PHP template engine. By default, it will look for a directory named `templates` in your root directory. You can override this in `config.yml`.

```yaml
templating:
    directory: "template-files"
```

Partials are loaded from the same directory.

From your controller, you can then call the `render()` method on Rauma's `PageController`, passing it a filename and an array of data. You can also use templating as a service:

```php
$this->service('templating')->render($template, $data);
```

The `PageController` class also has a `renderPage()` method. This will render the template and then render this inside a template called `layout.html`, which should contain a `{{{body}}}` placeholder.

You can override the name of `layout.html` in your own controller casses.

```php
$this->layout = 'another-parent-template.xml';
```

Metadata
--------

For metadata, such as title and meta tags, use the `Meta` object on the `PageController`.
