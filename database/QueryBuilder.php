<?php
namespace App\Database;
/**
 * Class QueryBuilder - it makes queries to database
 */
class QueryBuilder
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllCustomers($table1,$table2, $id1, $id2, $table3, $id3, $table4, $id4, $model = "")
    {
        $query = $this->pdo->prepare("SELECT * FROM {$table1} LEFT JOIN {$table2} ON {$table1}.{$id1} = {$table2}.{$id2} 
                                    LEFT JOIN {$table3} ON {$table1}.{$id3} = {$table3}.{$id2} 
                                    LEFT JOIN {$table4} ON {$table1}.{$id4} = {$table4}.{$id2}");
        $query->execute();

        if($model) {
            return $query->fetchAll(\PDO::FETCH_CLASS, $model);
        } else {
            return $query->fetchAll(\PDO::FETCH_OBJ);
        }
    }

    public function addNew($table,$payload)
    {
 
        $sql = sprintf("INSERT INTO %s (%s) VALUES (%s)",
            $table,
            implode(", ", array_keys($payload)),
            ":" . implode(", :", array_keys($payload))
        );
        $query = $this->pdo->prepare($sql); 
        $query->execute($payload);
    }
    
    public function update($table, $payload)
    {
        $id = $_POST['id'];
        unset($_POST['id']);

        $variables = "";
        foreach($_POST as $key =>  $element) {
             $variables.= $key . "='" . $element . "', ";
        }
        $variables = substr($variables, 0, -2);
        $sql = "UPDATE {$table} SET {$variables} WHERE id = '{$id}'";
        $query = $this->pdo->prepare($sql);
        $query->execute();
    }

    public function getOne($table1,$table2, $id1, $id2, $table3, $id3, $table4, $id4, $id, $model = "")
    {
        $query = $this->pdo->prepare("SELECT * FROM {$table1} 
        LEFT JOIN {$table2} ON {$table1}.{$id1} = {$table2}.{$id2} 
        LEFT JOIN {$table3} ON {$table1}.{$id3} = {$table3}.{$id2} 
        LEFT JOIN {$table4} ON {$table1}.{$id4} = {$table4}.{$id2} 
        WHERE {$table4}.{$id2} = $id ");
        $query->execute();
        if($model) {
            return $query->fetchAll(\PDO::FETCH_CLASS, $model);
        } else {
            return $query->fetchAll(\PDO::FETCH_OBJ);
        }
    }
    // public function getOne($table1, $id, $model = "")
    // {
    //     $query = $this->pdo->prepare("SELECT * FROM {$table} WHERE id='{$id}'");
    //     // dd($query);
    //     $query->execute();
    //     if($model) {
    //         return $query->fetchAll(\PDO::FETCH_CLASS, $model);
    //     } else {
    //         return $query->fetchAll(\PDO::FETCH_OBJ);
    //     }
    // }
    public function getOneUser($table, $email, $model = "")
    {
        $query = $this->pdo->prepare("SELECT * FROM {$table} WHERE email='{$email}'");
        $query->execute();

        if($model) {
            return $query->fetch(\PDO::FETCH_CLASS, $model);
        } else {
            return $query->fetch(\PDO::FETCH_OBJ);
        }
    }

    public function destroy($table, $id)
    {
        $query = $this->pdo->prepare("DELETE FROM {$table} WHERE id='{$id}'");
        $query->execute();
    }

    public function getAll($table, $model = "")
    {
        $query = $this->pdo->prepare("SELECT * FROM {$table}");
        $query->execute();

        if($model) {
            return $query->fetchAll(\PDO::FETCH_CLASS, $model);
        } else {
            return $query->fetchAll(\PDO::FETCH_OBJ);
        }
    }
}