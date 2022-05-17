<?php

namespace App\Models\DataBase;

require_once __DIR__."/../../../vendor/autoload.php";

use Dotenv;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../../../");
$dotenv->load();

class DataBase
{
    public $conn;

    public function connection()
    {
        try{
            $this->conn = new \PDO($_ENV['DB_TYPE'].': host='.$_ENV['DB_HOST'].'; dbname='.$_ENV['DB_NAME'].';charset=utf8', $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            //echo "Conexão estabelecida com sucesso!";

        }catch(\PDOException $erro){
            echo "Connection Established Not Successfully. Erro: " . $erro->getMessage(); 
        }

        return $this->conn;
    }
}