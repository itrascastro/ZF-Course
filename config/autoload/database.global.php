<?php

return array(
    'db' => array(
        'driver'            => 'Pdo',
        'dsn'               => 'mysql:dbname=zf2;host=localhost',
        'driver_options'    => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'database'  => 'Zend\Db\Adapter\AdapterServiceFactory', // it needs the 'db' key we previously defined
        ),
    ),
);