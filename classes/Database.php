<?php

namespace classes;

    class Database {

        private $type = 'mysql';
        private $server = 'localhost';
        private $db = 'todo';
        private $port = '3306';
        private $charset = 'utf8mb4';

        private $username = 'root';
        private $password = '';

        private $options = [

            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false

        ];
        
        private $pdo = null;

        //Upon creating a database object, it will connect to the database.
        public function __construct(){

            $dsn = "$this->type:host=$this->server;dbname=$this->db;port=$this->port;charset=$this->charset";

            try {
                $this->pdo = new \PDO($dsn, $this->username, $this->password, $this->options);
            } catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), $e->getCode());
            }
        }

        //Here you can get the pdo object from the database object so that you can do database queries, etc...
        public function getPdo() {
            return $this->pdo;
        }
        
    }
?> 