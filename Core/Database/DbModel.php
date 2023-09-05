<?php

namespace Core\Database;

use Core\Application;
use Core\Model;
use Illuminate\Database\QueryException;

abstract class DbModel extends Model
{
    abstract public static function tableName(): string;

    abstract public function attributes(): array;

    abstract public static function primaryKey(): string;


    public function save(): true
    {
        try {
            $table = $this->tableName();
            $attributes = $this->attributes();
            Application::$app->database->insertInto($table, $attributes);
        } catch (QueryException $e) {
            echo $e->getMessage();
//            throw new YourCustomException("Failed to insert data into example_table: " . $e->getMessage());
        }

        return true;
    }
    public function insert(array $data): void
    {
        Application::$app->database->insertInto(static::tableName(),$data);
    }
    public function updata( array $where, array $data): void
    {
        Application::$app->database->update(static::tableName(),$where,$data);
    }
    public function select(array $where ,string $column='*'){
        Application::$app->database->select(static::tableName(),$where,$column);
    }
    public function delete($id){
        Application::$app->database->delete(static::tableName(),$id);
    }

    public static function findOne($where)
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $sql = implode('AND', array_map(fn($attr) => "$attr = :$attr", $attributes));
        $stmt = Application::$app->database->pdo->prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $item) {
            $stmt->bindValue(":$key", $item);
        }
        $stmt->execute();
        return $stmt->fetchObject(static::class);

    }


}