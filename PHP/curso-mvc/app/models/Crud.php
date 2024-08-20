<?php

namespace app\models;

class Crud extends Connection{ // Define a classe Crud que herda da classe Connection

    public function create(){
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS); // Obtém o valor do campo 'nome' enviado via POST e o sanitiza para remover caracteres especiais
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL); // Obtém o valor do campo 'email' enviado via POST e o valida como um email

   

        $conn = $this->connect(); // Estabelece a conexão com o banco de dados usando o método connect() da classe Connection
        $sql = 'INSERT INTO tb_person VALUES(default, :nome, :email)';

        //$stmt = statement
        $stmt = $conn->prepare($sql); // Prepara a query para execução
        $stmt->bindParam(':nome', $nome); // Associa o valor de $nome ao placeholder ':nome' na query
        $stmt->bindParam(':email', $email); // Associa o valor de $email ao placeholder ':email' na query
        $stmt->execute();

        return $stmt; // Retorna o statement, que pode ser usado para verificar o sucesso da operação
    }
    
    public function read(){
        $conn = $this->connect();
        $sql = 'SELECT * FROM tb_person ORDER BY nome';

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }

    public function update(){
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

        $conn = $this->connect();
        $sql = "UPDATE tb_person SET nome = :nome, email = :email WHERE id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id);

        $stmt->execute();
        return $stmt;
    }

    public function delete(){
        $id = base64_decode(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS));

        $conn = $this->connect();
        $sql = "DELETE FROM tb_person WHERE id =:id";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt;
    }

    public function editForm(){
        $id = base64_decode(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS));

        $conn = $this->connect();
        $sql = 'SELECT * FROM tb_person WHERE id = :id';

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $result = $stmt->fetchAll();
        return $result;
    }
}