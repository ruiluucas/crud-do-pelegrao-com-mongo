<?php
require_once dirname(__FILE__) . '/../database.php';

class FornecedorService extends Database
{
    public function __construct()
    {
        try {
            $this->createTable("CREATE TABLE IF NOT EXISTS fornecedores (
                id INT(6) AUTO_INCREMENT PRIMARY KEY,
                nome VARCHAR(50) NOT NULL UNIQUE
            )");
        } catch (Exception $e) {
            throw new Exception("Erro ao conectar ao banco de dados: " . $e->getMessage());
        }
    }

    public function create($nome)
    {
        $id = $this->insert("INSERT INTO fornecedores (nome) VALUES ('{$nome}')");
        return $id;
    }

    public function getAll()
    {
        return $this->select("SELECT * FROM fornecedores");
    }

    public function getById($id)
    {
        $result = $this->select("SELECT * FROM fornecedores WHERE id = '{$id}'");
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
        $sql = "UPDATE fornecedores SET " . implode(',', $parts) . " WHERE id='{$id}'";
        return $this->update($sql);
    }

    public function delete($id)
    {
        return $this->delete("DELETE FROM fornecedores WHERE id='{$id}'");
    }
}
