<?php

namespace App\Models\DataBase;

class Sql
{

    public $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function insert($table, $dataTable, $keys, $params = array())
    {
        $cmd = "INSERT INTO $table ($dataTable) VALUES ($keys)";
        $stmt = $this->conn->prepare($cmd);

        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        $stmt->execute();
        return $stmt;
    }

    public function select($table)
    {
        $cmd = "SELECT * FROM $table";
        $stmt = $this->conn->prepare($cmd);
        $stmt->execute();
        return $stmt;
    }

    public function selectId($table, $id)
    {
        $cmd = "SELECT * FROM $table WHERE id LIKE :id";
        $stmt = $this->conn->prepare($cmd);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt;
    }

    public function update($table, $dataTableKeys, $params = array())
    {
        $cmd = "UPDATE $table SET $dataTableKeys";
        $stmt = $this->conn->prepare($cmd);

        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        $return = $stmt->execute();
        return $return;
    }

    public function delete($table, $id)
    {
        $cmd = "DELETE FROM $table WHERE id = :ID";
        $stmt = $this->conn->prepare($cmd);
        $stmt->bindParam(':ID', $id);
        $stmt->execute();
    }
}
