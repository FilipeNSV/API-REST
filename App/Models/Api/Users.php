<?php

namespace App\Models\Api;

use App\Models\DataBase\DataBase;
use App\Models\DataBase\Sql;

class Users
{
    private $table = 'user';

    public function selectAll()
    {

        $obDb = new DataBase;
        $db = $obDb->connection();

        $sql = new Sql($db);
        $result = $sql->select($this->table);

        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function select($id)
    {

        $obDb = new DataBase;
        $db = $obDb->connection();

        $sql = new Sql($db);
        $result = $sql->selectId($this->table, $id);

        if ($result->rowCount() > 0) {
            return $result->fetch(\PDO::FETCH_ASSOC);
        } else {
            throw new \Exception("Nenhum Usuário encontrado com esse ID!");
        }
    }

    public function insert($data)
    {
        $nome = $data['nome'];
        $idade = $data['idade'];

        $database = new DataBase;
        $db = $database->connection();

        $sql = new Sql($db);
        $result = $sql->insert($this->table, 'nome, idade', ':NO, :ID', array(
            ':NO' => $nome,
            ':ID' => $idade
        ));

        if ($result->rowCount() > 0) {
            return 'Usuaário(a) inserido com sucesso!';
        } else {
            throw new \Exception("Usuário não inserido!");
        }
    }

    public function update($data)
    {
        $nome = $data['nome'];
        $idade = $data['idade'];
        $id = $data['id'];

        $obDb = new DataBase;
        $db = $obDb->connection();

        $sql = new Sql($db);
        $result = $sql->update($this->table, 'nome = :NO, idade = :IDA WHERE id = :ID', array(
            ':NO' => $nome,
            ':IDA' => $idade,
            ':ID' => $id
        ));

        return $result;
    }

    public function delete($data)
    {
        $id = $data['id'];

        $obDb = new DataBase;
        $db = $obDb->connection();

        $sql = new Sql($db);
        $result = $sql->delete($this->table, $id);
        return $result;
    }
}