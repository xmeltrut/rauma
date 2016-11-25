Authorisation
=============

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
