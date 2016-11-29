Migration guide
===============

3.0
---

Controllers used to take a `Aura\Di\Container` object as their first argument. They must now take a `Rauma\Service\Container` object.

2.1
---

Implement a custom exception handler, or new error pages.

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
