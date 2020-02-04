<?php

class Database {

    protected $db = null;

    public function __construct()
    {
        try {
            $dsn        = "mysql:host=localhost;dbname=core;charset=utf8";
            $user       = "root";
            $password   = "k0s0ng!n";
            $this->db   = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

}