Authorisation
=============

Rauma comes with an authorisation framework. To use it, you will need to implement an authorisation controller that will handle logging in and out.

You can access the auth module as a service:

```php
$this->service('auth')
```

To log a user in:

```php
$this->service('auth')->authoriseUser(
    $user->getId(),
    $user->getRoleKeys(),
    ['name' => 'Jane']
);
```

The params are user ID, and optional arrays of roles and attributes.

To log a user out:

```php
$this->service('auth')->deauthoriseUser();
```

Other useful methods:

| Method         | Use                                          |
| -------------- | -------------------------------------------- |
| getId          | Get the user's ID.                           |
| hasRole        | Check a user has a specific role/permission. |
| hashPassword   | Used for registrations.                      |
| isLoggedIn     | Is the user currently logged in?             |
| verifyPassword | Check a password against a hash.             |

Require login
-------------

Use the `LoggedIn` annotation to require the user to log in.

```
@LoggedIn
```

This can be used on the controller or method level.

Require a group
---------------

Use the `Allowed` annotation to restrict a resource to a particular group.

```
@Allowed("admins,users")
```

Extending
---------

You can extend the `Authorisation` class and initialise it in your `config.yml`
file like any other service. Using the service name `auth` will allow Rauma
to pick it up and use it for annoted authorisations.
