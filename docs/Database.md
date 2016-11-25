Database
========

Rauma uses the Doctrine ORM. The framework initialises a service called `db` when you add database configuration into the `config.yml` file.

```yaml
database:
    entityPath: "src/Entity"
```

Connection details
------------------

The database connection details are read from environmental variables. This is how you would set them in your Apache configuration:

```
SetEnv app.database.host "localhost"
SetEnv app.database.user "user"
SetEnv app.database.password "password"
SetEnv app.database.name "db_name"
```

Host is optional, and will default to `localhost`.
