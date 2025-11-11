<?php
require_once dirname(__FILE__) . '/../database.php';

class ProdutoService extends Database
{
    public function __construct()
    {
        try {
            $this->createTable("CREATE TABLE IF NOT EXISTS produtos (
                id INT(6) AUTO_INCREMENT PRIMARY KEY,
                nome VARCHAR(50) NOT NULL UNIQUE,
                fornecedor_id INT(6),
                preco float,
                FOREIGN KEY (fornecedor_id) REFERENCES fornecedores(id) 
            )");
        } catch (Exception $e) {
            throw new Exception("Erro ao conectar ao banco de dados: " . $e->getMessage());
        }
    }

    public function create($nome, $fornecedorId, $preco)
    {
        $id = $this->insert("INSERT INTO produtos (nome, preco, fornecedor_id) VALUES ('$nome', $preco, $fornecedorId)");
        return $id;
    }

    public function getAll()
    {
        return $this->select("SELECT produtos.id, produtos.nome as nome_produto, fornecedores.nome nome_fornecedor 
            FROM produtos, fornecedores 
            where produtos.fornecedor_id = fornecedores.id 
        ");
    }

    public function getById($id)
    {
        $result = $this->select("SELECT * FROM produtos WHERE id = '{$id}'");
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
        $sql = "UPDATE produtos SET " . implode(',', $parts) . " WHERE id='{$id}'";
        return $this->update($sql);
    }

    public function delete($id)
    {
        return $this->delete("DELETE FROM produtos WHERE id='{$id}'");
    }
}
