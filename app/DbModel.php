<?php

namespace App;

 use App\Database\DatabaseConnection;

 abstract class DbModel
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