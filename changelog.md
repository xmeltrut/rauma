Changelog
=========

5.0
---

* Upgrade to PHP 8

4.0.4
-----
* Update dependencies

4.0
---
* Add `Response` proxy objects that can be called from the Rauma namespace
* Add `isLoggedIn` method to `Authorisation` class
* Upgraded all dependencies and moved to PHP 7.1
* Remove `description` from `Authorisation` in favour of attributes
* Custom `auth` services can now be configured

3.14
----
* Validate we have the database config before trying to use it

3.13
----
* Remove type expectations from exception handling to support both PHP 5 and 7

3.12
----
* Add `addHelper` method to `Templating` class

3.11
----
* Add `isPut` method to `Controller` class

3.10.1
------
* Only instanciate the exception controller if there is an exception

3.10
----
* Authorisation will now reject passwords that are blank or null

3.9
---
* Add string case manipulation helpers to templating engine

3.8
---
* Custom error handlers are now supported for recoverable errors

3.7
---
* Add `exists` method to `Templating` class

3.6.1
-----
* Updating documentation on error handling

3.6
---
* Ability to store arbitary user data in the `Authorisation` object

3.5
---
* Updated Aura Session to version 2.1
* Add `getJson` method to `Controller` class

3.4
---
* Add `setKeywords` method to `Meta` templating class

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
