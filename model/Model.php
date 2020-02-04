<?php

class Model extends Database {

    // Common Property
    private $list_fields = [];
    private $list_clause = [];
    private $list_groups = [];
    private $list_params = [];
    private $list_join   = [];
    private $select, $table, $sortby, $sortdir, $offset, $limit;

    // SQL SET
    protected function select($fields)
    {
        $this->list_fields[]    = $fields;
    }

    protected function from($table)
    {
        $this->table = $table;
    }

    protected function where($criteria, $params)
    {
        $this->list_clause[]    = $criteria;
        $this->list_params      = $params;
    }

    protected function order_by($sortby, $sortdir)
    {
        $this->sortby   = $sortby;
        $this->sortdir  = $sortdir;
    }

    protected function limit($limit, $offset)
    {
        $this->limit    = $limit;
        $this->offset   = $offset;
    }

    protected function group_by($groups)
    {
        $this->list_groups[]    = $groups;
    }

    protected function join($join, $direction = "join")
    {
        $this->list_join[$direction]    = $join;
    }

    // SQL Field & Param SET

    private function setSelect()
    {
        return empty($this->list_fields) ? "*" : implode(",", $this->list_fields);
    }

    private function setFrom()
    {
        return empty($this->table) ? null : $this->table;
    }

    private function setWhere()
    {
        return empty($this->list_clause) ? "1=1" : implode(" and ", $this->list_clause);
    }

    private function setOrder()
    {
        return empty($this->sortby) ? "" : "order by $this->sortby $this->sortdir";
    }

    private function setLimit()
    {
        return empty($this->limit) ? "" : "limit $this->offset, $this->limit";
    }

    private function setGroupBy()
    {
        return empty($this->list_groups) ? "" : "group by ".implode(",", $this->list_groups);
    }

    private function setJoin()
    {
        if (empty($this->list_join)) {
            return "";
        } else {
            $join_statement = [];
            foreach ($this->list_join as $key => $val) {
                $join_statement[]   = $key." ".$val;
            }
            return implode(" ", $join_statement);
        }
    }

    private function setInsertParam($data)
    {
        $ret    = [];
        $fields = [];
        $params = [];
        $value  = [];

        foreach ($data as $key => $val) {
            $fields[]           = $key;
            $params[]           = ":".$key;
            $value[":".$key]    = is_string($val) ? $this->db->quote($val) : (int) $val;
        }

        $ret['fields']  = implode(",", $fields);
        $ret['params']  = implode(",", $params);
        $ret['value']   = $value;

        return $ret;
    }

    private function setUpdateParam($data, $clause)
    {
        $ret    = [];
        $fields = [];
        $value  = [];
        $clause = [];

        foreach ($data as $key => $val) {
            $fields[]           = $key . "=:".$key;
            $value[":".$key]    = is_string($val) ? $this->db->quote($val) : (int) $val;
        }

        foreach ($clause as $key => $val) {
            $clause[]           = $key."=:".$key;
            $value[":".$key]    = is_string($val) ? $this->db->quote($val) : (int) $val;
        }

        $ret['fields']  = implode(",", $fields);
        $ret['clause']  = implode(" and ", $clause);
        $ret['value']   = $value;

        return $ret;
    }

    private function setDeleteParam($clause)
    {
        $ret    = [];
        $clause = [];
        $params = [];

        foreach ($clause as $key => $val) {
            $clause[]           = $key . "=:".$key;
            $params[":".$key]   = is_string($val) ? $this->db->quote($val) : (int) $val;
        }

        $ret['clause']  = implode(",", $clause);
        $ret['params']  = $params;
    }

    // SQL Query Builder

    protected function get($table = null)
    {
        $data_select    = $this->setSelect();
        $data_table     = $this->setFrom() !== null ? $this->setFrom() : $table;
        $data_join      = $this->setJoin();
        $data_clause    = $this->setWhere();
        $data_order     = $this->setOrder();
        $data_limit     = $this->setLimit();
        $data_groups    = $this->setGroupBy();
        $sql            = trim("SELECT $data_select FROM $data_table $data_join WHERE $data_clause $data_order $data_limit $data_groups", " ");
        $stmt           = $this->db->prepare($sql);

        empty($this->list_params) ? $stmt->execute() : $stmt->execute($this->list_params);
        return $stmt->fetchAll();
    }

    protected function getCount($table = null)
    {
        $data_select    = "COUNT(*) AS total";
        $data_table     = $this->setFrom() !== null ? $this->setFrom() : $table;
        $data_join      = $this->setJoin();
        $data_clause    = $this->setWhere();
        $sql            = trim("SELECT $data_select FROM $data_table $data_join WHERE $data_clause", " ");
        $stmt           = $this->db->prepare($sql);

        empty($this->list_params) ? $stmt->execute() : $stmt->execute($this->list_params);
        return $stmt->fetch()["total"];
    }

    protected function insert($table, $data)
    {
        $data_set   = $this->setInsertParam($data);
        $sql        = "INSERT INTO $table (".$data_set['fields'].") VALUES(".$data_set['params'].")";
        $stmt       = $this->db->prepare($sql);
        $exe        = $stmt->execute($data_set['value']);
        
        return $exe;
    }

    protected function update($table, $data, $clause)
    {
        $data_set   = $this->setUpdateParam($data, $clause);
        $sql        = "UPDATE $table SET ".$data_set['fields']." WHERE ".$data_set['clause'];
        $stmt       = $this->db->prepare($sql);
        $exe        = $stmt->execute($data_set['value']);

        return $exe;
    }

    protected function delete($table, $clause)
    {
        $data_set   = $this->setDeleteParam($clause);
        $sql        = "DELETE FROM $table WHERE ".$data_set['clause'];
        $stmt       = $this->db->prepare($sql);
        $exe        = $stmt->execute($data_set['value']);

        return $exe;
    }


}