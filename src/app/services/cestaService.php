<?php
require_once dirname(__FILE__) . '/../database.php';

class CestaService extends Database
{
    public function __construct()
    {
        try {
            $this->createTable("CREATE TABLE IF NOT EXISTS cestas (
                id INT(6) AUTO_INCREMENT PRIMARY KEY,
                pessoa_id INT(6),
                produto_id INT(6),
                FOREIGN KEY (pessoa_id) REFERENCES pessoas(id),
                FOREIGN KEY (produto_id) REFERENCES produtos(id) 
            )");
        } catch (Exception $e) {
            throw new Exception("Erro ao conectar ao banco de dados: " . $e->getMessage());
        }
    }

    public function create($userId, $produtoId)
    {
        $id = $this->insert("INSERT INTO cestas (pessoa_id, produto_id) VALUES ({$userId}, {$produtoId})");
        return $id;
    }

    public function getProdutosByUserId()
    {
        session_start();
        $userId = $_SESSION['id'];
        $produtos = $this->select("SELECT produtos.id, produtos.nome AS nome_produto, fornecedores.nome AS nome_fornecedor, produtos.preco as preco_produto
            FROM cestas 
            INNER JOIN produtos ON cestas.produto_id = produtos.id 
            INNER JOIN fornecedores ON produtos.fornecedor_id = fornecedores.id
            WHERE cestas.pessoa_id = {$userId}");
        return $produtos;
    }

    public function getAll()
    {
        return $this->select("SELECT * FROM cestas");
    }

    public function getById($id)
    {
        $result = $this->select("SELECT * FROM cestas WHERE id = '{$id}'");
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
        $sql = "UPDATE cestas SET " . implode(',', $parts) . " WHERE id='{$id}'";
        return $this->update($sql);
    }

    public function delete($id)
    {
        return $this->delete("DELETE FROM cestas WHERE id='{$id}'");
    }
}
