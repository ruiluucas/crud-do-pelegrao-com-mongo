<?php

class Database
{

    //Algumas variáveis com dados sobre o Banco. 
    private $servername = "db";
    private $username = "root";
    private $password = "root";
    private $dbname = "meubanco";
    private $instance;

    // método que retorna a instância de conexão
    function getInstance()
    {
        if (empty($instance)) {
            $instance = $this->connection();
        }
        return $instance;
    }

    //método que cria a instância de conexão. 
    private function connection()
    {
        try {
            $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            if (strpos($e->getMessage(), "Unknown database 'meubanco'")) {
                $conn = $this->createDB();
                return $conn;
            }
        }
    }

    //Métodos do CRUD
    function createDB()
    {
        $sql = '';
        try {
            $cnx = new PDO("mysql:host=$this->servername", $this->username, $this->password);
            $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "CREATE DATABASE IF NOT EXISTS $this->dbname";
            $cnx->exec($sql);
            $cnx->exec("USE $this->dbname");

            return $cnx;
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    function createTable($sql)
    {
        try {
            $cnx = $this->getInstance();

            $cnx->exec($sql);
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    function insert($sql)
    {
        try {
            $cnx = $this->getInstance();
            $cnx->exec($sql);

            $lastId = $cnx->lastInsertId(); // pega o ID gerado automaticamente
            return $lastId;
        } catch (PDOException $e) {
            return $e;
        }
    }

    function select($sql)
    {

        try {
            $cnx = $this->getInstance();
            $result = $cnx->query($sql);
            $data = $result->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    function update($sql)
    {

        try {
            $cnx = $this->getInstance();
            $result = $cnx->query($sql);

            return $result;
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    function delete($sql)
    {

        try {
            $cnx = $this->getInstance();
            $result = $cnx->query($sql);

            return $result;
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }
}
