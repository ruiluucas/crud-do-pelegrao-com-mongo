<?php

require_once __DIR__ . '/../vendor/autoload.php';

use MongoDB\Client;

class Database
{
    private $clientInstance;

    private $dbInstance;

    private function getClient()
    {
        if (empty($this->clientInstance)) {
            try {
                $this->clientInstance = new Client("mongodb://admin:admin@mongo:27017");
            } catch (Exception $e) {
                die("Erro ao conectar ao MongoDB: " . $e->getMessage());
            }
        }
        return $this->clientInstance;
    }

    private function getDatabase()
    {
        if (empty($this->dbInstance)) {
            $this->dbInstance = $this->getClient()->getDatabase("teste");
        }
        return $this->dbInstance;
    }

    public function selectCollection(string $collectionName)
    {
        return $this->getDatabase()->getCollection($collectionName);
    }

    protected function insert(string $collectionName, $document)
    {
        try {
            $collection = $this->selectCollection($collectionName);

            $result = $collection->insertOne($document);

            return $result->getInsertedId();
        } catch (Exception $e) {
            echo "Erro ao inserir: " . $e->getMessage();
            return null;
        }
    }

    protected function find(string $collectionName, array $filter = [], array $options = [])
    {
        try {
            $db = $this->getDatabase();
            $collection = $db->selectCollection($collectionName);

            $cursor = $collection->find($filter, $options);

            return $cursor->toArray();
        } catch (Exception $e) {
            echo "Erro ao buscar: " . $e->getMessage();
            return [];
        }
    }

    protected function findOne(string $collectionName, array $filter = [], array $options = [])
    {
        try {
            $db = $this->getDatabase();
            $collection = $db->selectCollection($collectionName);

            return $collection->findOne($filter, $options);
        } catch (Exception $e) {
            echo "Erro ao buscar um: " . $e->getMessage();
            return null;
        }
    }

    protected function update(string $collectionName, array $filter, array $update)
    {
        try {
            $db = $this->getDatabase();
            $collection = $db->selectCollection($collectionName);

            $result = $collection->updateMany($filter, $update);

            return $result->getModifiedCount();
        } catch (Exception $e) {
            echo "Erro ao atualizar: " . $e->getMessage();
            return 0;
        }
    }

    protected function delete(string $collectionName, array $filter)
    {
        if (empty($filter)) {
            echo "Erro: Filtro de deleção não pode ser vazio para evitar deleção acidental de toda a collection.";
            return 0;
        }

        try {
            $db = $this->getDatabase();
            $collection = $db->selectCollection($collectionName);

            $result = $collection->deleteMany($filter);

            return $result->getDeletedCount();
        } catch (Exception $e) {
            echo "Erro ao deletar: " . $e->getMessage();
            return 0;
        }
    }
}
