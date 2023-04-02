<?php

namespace App\Database;

use PDO;

class DatabaseConnection
{
    public PDO $pdo;

    public function __construct(array $config) //pass $_ENV super global as config
    {

        // config - make sure that array key correlates with env file
        $type = $config['DB_TYPE'] ?? '';
        $host = $config['DB_HOST'] ?? '';
        $port = $config['DB_PORT'] ?? '';
        $table = $config['DB_NAME'] ?? '';
        $user = $config['DB_USER'] ?? '';
        $password = $config['DB_PASSWORD'] ?? '';

        //set dsn for pdo object
        $dsn = sprintf(
            '%s:host=%s;port=%d;dbname=%s',
            $type,
            $host,
            $port,
            $table,
        );


        // create new pdo connection
        $this->pdo = new PDO($dsn, $user, $password);

        // throw exceptions if in dev mode
        if($config['APP_ENV'] === 'dev'){

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }

    }

}