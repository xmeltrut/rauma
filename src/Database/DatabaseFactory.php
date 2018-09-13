<?php

namespace Rauma\Database;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Exception;

class DatabaseFactory
{
    /**
     * Create a doctrine entity manager.
     *
     * @return EntityManager
     */
    public static function create($appPath, $config)
    {
        $isDevMode = true;
        $paths = [$appPath . '/' . $config['entityPath']];
        $metadata = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);

        // check we have the config
        self::validateConfig();

        // gather parameters
        $host = (getenv('app.database.host')) ? getenv('app.database.host') : 'localhost';
        
        // database configuration parameters
        $dbParams = [
            'driver'   => 'pdo_mysql',
            'host'     => $host,
            'user'     => getenv('app.database.user'),
            'password' => getenv('app.database.password'),
            'dbname'   => getenv('app.database.name'),
            'charset'  => 'utf8'
        ];
        
        // obtaining the entity manager
        return EntityManager::create($dbParams, $metadata);
    }

    private static function validateConfig()
    {
        $required = ['app.database.user', 'app.database.password', 'app.database.name'];

        foreach ($required as $key) {
            if (!getenv($key)) {
                throw new Exception(sprintf('Missing database config item: "%s"', $key));
            }
        }
    }
}
