<?php

namespace App;

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

    public function prepare($sql)
    {
        return $this->db->pdo->prepare($sql);
    }

     // Each where should look like this
     //      [
     //         'column' => '',
     //         'operator' => '',
     //         'value' => '',
     //     ];
     public function findAllWhere($where) : array
     {
         $tableName = static::tableName();

         // create array where with values for example ':colum = :colum' or 'column LIKE :column'
         $attributes = array_map(function ($condition){
             $column = $condition['column'];
             $operator = $condition['operator'];

             return $column.' '.$operator.' :'.$column;
         }, $where);


         $sql = implode(" AND ", $attributes);

         $statement = $this->prepare("SELECT * FROM $tableName WHERE $sql");

         foreach ($where as $condition){
             $column = $condition['column'];
             $value = $condition['value'];

             if(is_int($value)){

                 $statement->bindValue(":$column", $value, \PDO::PARAM_INT);

             } else {

                 $statement->bindValue(":$column", $value);

             }
         }

         $statement->execute();

         return $statement->fetchAll();

     }

}