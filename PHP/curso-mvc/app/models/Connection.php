<?php

namespace app\models;

abstract class Connection{ //Evitar que a classe não seja instanciada por motivos de segurança
    private $dbname = 'mysql:host=localhost;dbname=cursomvc';
    private $user = 'root';
    private $pass = 'root1234';

    protected function connect(){
        try {
            $conn = new \PDO($this->dbname, $this->user, $this->pass); //relacionamento de composição entre classes
            $conn->exec("set names utf8"); // Para que as informaçõs do BD venham ja configuradas com acentuação (~ ç ´...)
            return $conn;
        } catch (\PDOException $erro) {
            echo $erro->getMessage();
        }
    }
    
}