<?php

namespace Rauma\Database;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

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
        
        // database configuration parameters
        $dbParams = [
            'driver'   => 'pdo_mysql',
            'user'     => getenv('app.database.user'),
            'password' => getenv('app.database.password'),
            'dbname'   => getenv('app.database.name'),
            'charset'  => 'utf8'
        ];
        
        // obtaining the entity manager
        return EntityManager::create($dbParams, $metadata);
    }
}
