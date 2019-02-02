Migration guide
===============

4.0
---

The breaking change to be aware of is that the `description` property has now
disappeared from the `Authorisation` class. If you want to store more information
than the user ID, use the attributes array.

`4.0` also bumps the PHP version requirement to `7.1`.

Optionally, you may also want to start using the new `Response` objects Rauma
now provides, and the `isLoggedIn` auth service fucntion.

3.2
---

Configure sitemaps, if required.

3.0
---

Controllers used to take a `Aura\Di\Container` object as their first argument. They must now take a `Rauma\Service\Container` object.

2.1
---

Implement a custom exception handler, if required.

Rename forbidden.html to 403.html.

2.0
---

This changes the way we do authorisation. Previously, when we logged a user in we passed in an identifier and a list of roles:

```php
$this->service('auth')->authoriseUser(
    sprintf('%s <%s>', $user->getFullName(), $user->getEmail()),
    $user->getRoleKeys()
);
```

Following the upgrade, we pass in an ID first:

```php
$this->service('auth')->authoriseUser(
    $user->getId(),
    sprintf('%s <%s>', $user->getFirstName(), $user->getEmail()),
    $user->getRoleKeys()
);
```

The `getIdentifier` method which used to return a text string describing the user has now been replaced by a `getId` and `getDescription` methods.
