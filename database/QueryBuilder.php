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


    public function getThreeAppointments($table1,$table2, $id1, $id2, $table3, $id3, $table4, $id4, $model = "")
    {
        $query = $this->pdo->prepare("SELECT * FROM {$table1} LEFT JOIN {$table2} ON {$table1}.{$id1} = {$table2}.{$id2} 
                                    LEFT JOIN {$table3} ON {$table1}.{$id3} = {$table3}.{$id2} 
                                    LEFT JOIN {$table4} ON {$table1}.{$id4} = {$table4}.{$id2}
                                    ORDER BY appointments.date DESC
                                    LIMIT 3");
                                 
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
    


    public function getOne($table1,$table2, $id1, $id2, $table3, $id3, $table4, $id4, $table5, $id5, $table6,$id6, $table7,$id7, $id, $model = "")
    {
        $query = $this->pdo->prepare("SELECT * FROM {$table1} 
                LEFT JOIN {$table2} ON {$table1}.{$id1} = {$table2}.{$id2} 
                LEFT JOIN {$table3} ON {$table1}.{$id3} = {$table3}.{$id2} 
                LEFT JOIN {$table4} ON {$table1}.{$id4} = {$table4}.{$id2} 
                LEFT JOIN {$table5} ON {$table3}.{$id5} = {$table5}.{$id2} 
                LEFT JOIN {$table6} ON {$table3}.{$id6} = {$table6}.{$id2} 
                LEFT JOIN {$table7} ON {$table3}.{$id7} = {$table7}.{$id2} 
                WHERE {$table4}.{$id2} = $id");
        $query->execute();
        if($model) {
            return $query->fetchAll(\PDO::FETCH_CLASS, $model);
        } else {
            return $query->fetchAll(\PDO::FETCH_OBJ);
        }
    }

    public function destroy($table, $deleted)
    {
        $query = $this->pdo->prepare("DELETE FROM {$table} WHERE deleted='{$deleted}'");
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
    public function editClient($table, $payload, $params){
        $query = $this->pdo->prepare("UPDATE {$table} SET first_name = '{$payload['first_name']}', last_name = '{$payload['last_name']}', address = '{$payload['address']}', city = '{$payload['city']}', state = '{$payload['state']}' WHERE id = $params ");
        if ($query->execute($payload)){
          echo json_encode("Successfully updated");
        }else{
          echo "<br> Error: Database not updated";
          var_dump($query->errorInfo());
        }
    }
    
    public function update($table, $payload){
        $query = $this->pdo->prepare("UPDATE {$table} SET 'deleted' = '{$payload['deleted']}' WHERE id = {$payload['id']} ");
        if ($query->execute($payload)){
          echo json_encode("Successfully updated");
        }else{
          echo "<br> Error: Database not updated";
          var_dump($query->errorInfo());
        }
    }
}