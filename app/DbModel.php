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

    public function findWhereId($id, $returnObject = true)
    {
        // get model table name
        $tableName = static::tableName();

        // preapre statement
        $statement = $this->prepare("SELECT * FROM $tableName WHERE id = :id");

        // bind values
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);

        // execute statement
        $statement->execute();

        return $returnObject ? $statement->fetchObject(static::class) : $statement->fetch(\PDO::FETCH_ASSOC);

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

     public function deduct($id, $columnToDeduct, $value = 1)
     {
         // get model table name
         $tableName = static::tableName();

         // prepare statement
         $statement = $this->prepare("SELECT * FROM $tableName WHERE id = :id UPDATE $columnToDeduct = $columnToDeduct - :$columnToDeduct");

         // bind values
         $statement->bindValue(':id', $id, \PDO::PARAM_INT);
         $statement->bindValue(":$columnToDeduct", $value, \PDO::PARAM_INT);

          return $statement->execute();
     }

}