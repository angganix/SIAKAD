<?php

class Akses_role extends Model {

    private $db;
    public $table = "role_detail";
    public $clause, $params;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAll()
    {
        $ret    = [];
        $query  = "SELECT * FROM $this->table WHERE $this->clause";
        $stmt   = $this->db->prepare($query);

        if ($stmt->execute($this->params)) {
            $ret['result']  = $stmt->fetchAll();
        } else {
            $ret['status']  = false;
        }

        return $ret;
        unset($stmt);
    }

    public function getAkses()
    {
        $query  = "SELECT * FROM role WHERE 1=1";
        $stmt   = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
        unset($stmt);
    }

}