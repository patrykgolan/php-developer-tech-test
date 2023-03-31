<?php

namespace App\Database;

class DatabaseConnection
{
    public \PDO $pdo;

    public function __construct(array $config)
    {
        // config from env
        $type = $config['db_type'] ?? '';
        $host = $config['db_host'] ?? '';
        $port = $config['db_port'] ?? '';
        $table = $config['db_name'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';

        //set dsn for pdo object
        $dsn = $type.':host'.$host.':'.$port.';dbname='.$table;

        // create new pdo connection
        $this->pdo = new \PDO($dsn, $user, $password);

        // throw exceptions if in dev mode
        if($config['app_env'] === 'dev'){

            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        }

    }
}