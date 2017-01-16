Changelog
=========

3.3
---
* Add `getQuery` method to base controller, returning a `Collection`

3.2
---
* Add sitemap generator

3.1
---
* Multiple templating directories can now be used

3.0
---
* New service container system
* Ability to inject custom services

2.1.1
-----
* Fixing but with exception controller

2.1
---
* Templating config is now optional
* Database configuration is now optional
* Default forbidden template is now 403.html, not forbidden.html
* Added support for custom exception controllers
* Automatically support HEAD requests when a GET request is mapped

2.0
---
* New authorisation system

1.1.1
-----
* Allow host to be set on database connection

1.1
---
* Add canonical URL support to meta class
* Bug fix for template path

1.0.3
-----
* Bug fix for user roles not being set

1.0.2
-----
* Authentication now supports user role checking

1.0.1
-----
* Throw exception if config file does not exist
* Set a default directory for templates
