<?php


namespace Api\Dao;


use PDO;


trait Connect
{
    private $host;
    private $port;
    private $user;
    private $password;
    private $database;
    private $connection;

    public function __construct()
    {
        $this->setParams();
        $this->connect();
    }

    private function setParams()
    {
        $this->host = 'localhost';
        $this->port = '3306';
        $this->user = 'root';
        $this->password = '';
        $this->database = 'rest_api';
    }

    protected function connect()
    {
        $this->connection = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->database", $this->user, $this->password);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    protected function getConnect(): PDO
    {
        return $this->connection;
    }
}