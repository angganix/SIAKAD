<?php

class Database {

    protected $db = null;

    public function __construct()
    {
        try {
            require_once "../config/db_conf.php";
            $this->db   = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8", $DB_USER, $DB_PASS);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

}