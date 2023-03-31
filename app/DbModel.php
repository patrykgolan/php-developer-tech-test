<?php

namespace App;

 use app\core\Application;
 use App\Database\DatabaseConnection;

 abstract class DbModel extends Model
{
    protected DatabaseConnection $db;
    public function __construct()
    {
        $this->db = new DatabaseConnection($_ENV);
    }

     public static abstract function tableName(): string;

     public static abstract function attributes(): array;

     public static abstract function primaryKey(): string;


}