<?php

class User extends Model
{

    private $db;
    private $table = "admin";
    public $fields  = ["username","password","nama","email","no_telpon","akses"];
    public $clause, $params, $sortby, $sortdir, $offset, $limit;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAll()
    {
        $query  = "SELECT $this->table.*, role.nama_role AS str_akses FROM $this->table LEFT JOIN role ON $this->table.akses = role.id "
                . "WHERE $this->clause ORDER BY $this->sortby $this->sortdir LIMIT $this->offset, $this->limit";
        $stmt   = $this->db->prepare($query);

        if ($stmt->execute($this->params)) {
            return $stmt->fetchAll();
        } else {
            return [];
        }
        unset($stmt);
    }

    public function getCount()
    {
        $query  = "SELECT COUNT(*) AS total FROM $this->table WHERE $this->clause";
        $stmt   = $this->db->prepare($query);

        if ($stmt->execute($this->params)) {
            return $stmt->fetch()['total'];
        } else {
            return 0;
        }
        unset($stmt);
    }

    public function getEdit()
    {
        $query  = "SELECT * FROM $this->table WHERE $this->clause";
        $stmt   = $this->db->prepare($query);

        if ($stmt->execute($this->params)) {
            return $stmt->fetch();
        } else {
            return [];
        }
        unset($stmt);
    }

    public function addData()
    {
        $data_set   = $this->setInsertParam($this->fields);
        $query      = "INSERT INTO $this->table (".$data_set['fields'].") VALUES(".$data_set['params'].")";
        $stmt       = $this->db->prepare($query);

        if ($stmt->execute($this->params)) {
            return true;
        } else {
            return $query;
        }
        unset($stmt);
    }

    public function updateData($data_fields)
    {
        $data_set   = $this->setUpdateParam($data_fields);
        $query      = "UPDATE $this->table SET ".$data_set['fields']." WHERE id=:id";
        $stmt       = $this->db->prepare($query);

        if ($stmt->execute($this->params)) {
            return true;
        } else {
            return false;
        }
        unset($stmt);
    }

    public function deleteData()
    {
        $query  = "DELETE FROM $this->table WHERE $this->clause";
        $stmt   = $this->db->prepare($query);

        if ($stmt->execute($this->params)) {
            return true;
        } else {
            return false;
        }
        unset($stmt);
    }


    public function cekLogin()
    {
        $ret    = [];
        $query  = "SELECT * FROM $this->table WHERE $this->clause";
        $stmt   = $this->db->prepare($query);

        if ($stmt->execute($this->params)) {
            if ($stmt->rowCount() > 0) {
                $ret['status']  = true;
                $ret['result']  = $stmt->fetch();
            } else {
                $ret['status']  = "not_found";
                $ret['result']  = [];
            }
        } else {
            $ret['status']  = false;
            $ret['result']  = [];
        }

        return $ret;
    }
}
