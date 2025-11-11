<?php
require('./app/database.php');

class PessoaService
{
  private $database;

  public function __construct()
  {
    try {
      $this->database = new Database();

      $this->database->createTable("CREATE TABLE IF NOT EXISTS pessoas (
          id INT(6) AUTO_INCREMENT PRIMARY KEY,
          email VARCHAR(50) NOT NULL UNIQUE,
          senha VARCHAR(255) NOT NULL
        )");
    } catch (Exception $e) {
      throw new Exception("Erro ao conectar ao banco de dados: " . $e->getMessage());
    }
  }

  public function login($email = null, $senha = null)
  {
    $result = $this->database->select("SELECT * FROM pessoas WHERE email='$email'");
    if (is_array($result) && count($result) > 0) {
      $passwordVerify =  password_verify($senha, $result[0]['senha']);
      if ($passwordVerify) {
        return $result[0]['id'];
      }
      return 0;
    }
    return null;
  }

  public function create($email = null, $senha = null)
  {
    $id = $this->database->insert("INSERT INTO pessoas (email, senha) VALUES ('{$email}', '{$senha}')");
    return $id;
  }

  public function getAll()
  {
    return $this->database->select("SELECT * FROM pessoas");
  }

  public function getById($id)
  {
    $result = $this->database->select("SELECT * FROM pessoas WHERE id = '{$id}'");
    if (is_array($result) && count($result) > 0) {
      return $result[0];
    }
    return null;
  }

  public function update($id, $email = null, $senha = null)
  {
    $parts = [];
    if ($email !== null) $parts[] = "email='{$email}'";
    if ($senha !== null) $parts[] = "senha='" . password_hash($senha, PASSWORD_DEFAULT) . "'";
    if (empty($parts)) return false;
    $sql = "UPDATE pessoas SET " . implode(',', $parts) . " WHERE id='{$id}'";
    return $this->database->update($sql);
  }

  public function delete($id)
  {
    return $this->database->delete("DELETE FROM pessoas WHERE id='{$id}'");
  }
}
