<?php

namespace lib;

/**
 * Class eatMongo
 *
 * mongoDb简易封装
 *
 * 1. 目前是初步还不能使用, where条件还没有写
 *
 */
class eatMongo
{
    private $handle = null;

    private $bulk = null;

    private $namespace = '';

    public function __construct(string $host = '127.0.0.1',string $port = '27017', string $userName, string $passWd)
    {

        $url = "mongodb://{$host}:{$port}";

        $this->handle = new MongoDB\Driver\Manager($url);
    }

    public function insert(array $document)
    {
        $document['_id'] = new MongoDB\BSON\ObjectId();

        $_id = $this->initBulk()->insert($document);

        $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
        $result = $this->handle->executeBulkWrite($this->namespace, $this->bulk, $writeConcern);

    }

    public function search(array $filter,array $option)
    {
        $query = new MongoDB\Driver\Query($filter, $option);
        $cursor = $this->handle->executeQuery($this->namespace, $query);

        $document = [];
        foreach ($cursor as $key => $value) {

        }
    }

    public function update(array $filter, array $document, array $option)
    {
        $this->initBulk()->update($filter, $document, $option);

        $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);

        $this->handle->executeBulkWrite($this->namespace, $this->bulk, $writeConcern);
    }

    public function delete(array $filter, array $option)
    {
        $this->initBulk()->delete($filter, $option);

        $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);

        $this->handle->executeBulkWrite($this->namespace, $this->bulk, $writeConcern);
    }

    public function setNamespace(string $namespace)
    {
        $this->namespace = $namespace;

        return $this;
    }

    public function getNamespace()
    {
        return $this->namespace;
    }

    protected function initBulk()
    {
        if ($this->bulk === null) {
            $this->bulk = new MongoDB\Driver\BulkWrite();
        }

        return $this->bulk;
    }
}