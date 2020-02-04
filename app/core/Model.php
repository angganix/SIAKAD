<?php

class Model extends Database {

    private $fields = [], $table, $clause, $params, $data_set, $sortby, $sortdir, $offset, $limit, $criteria;
    private $list_join = [], $list_criteria = [], $list_group_by;

    // Base SQL Set
    protected function select($fields) {
        $this->fields[] = $fields;
    }

    protected function from($table)
    {
        $this->table    = $table;
    }

    protected function join($join, $direction = "join")
    {
        $this->list_join[$direction] = $join;
    }

    protected function where($criteria, $operator = "and")
    {
        $this->list_criteria[$operator]  = $criteria;
    }

    protected function order_by($sortby, $sortdir)
    {
        $this->sortby   = $sortby;
        $this->sortdir  = $sortdir;
    }

    protected function limit($limit, $offset)
    {
        $this->offset   = $offset;
        $this->limit    = $limit;
    }

    protected function group_by($fields)
    {
        $this->list_group_by[]  = $fields;
    }

    // SQL SET Validation
    private function setSelect()
    {
        if (empty($this->fields)) {
            return "*";
        } else {
            return implode(",", $this->fields);
        }
    }

    private function setFrom()
    {
        if (empty($this->table)) {
            return null;
        } else {
            return $this->table;
        }
    }

    private function setWhere()
    {
       if (empty($this->list_criteria)) {
           return "1=1";
       } else {
           $list_clause = [];
           foreach ($this->list_criteria as $key => $val) {
               $list_clause[] = $key ." ".$val;
           }
           return implode(" ", $list_clause);
       }
    }

    private function setOrderBy()
    {
        if (empty($this->sortby)) {
            return null;
        } else {
            return "order by $this->sortby $this->sortdir";
        }
    }

    private function setLimit()
    {
        if (empty($this->limit)) {
            return null;
        } else {
            return "limit $this->offset, $this->limit";
        }
    }

    private function setGroupBy()
    {
        if (empty($this->list_group_by)) {
            return null;
        } else {
            return "group by ".implode(",", $this->list_group_by);
        }
    }

    // SQL SET Binding Params

    protected function setSearch($fields, $text_search, $default_criteria)
    {
        $ret    = [];

        if ($text_search !== "") {
            $search_text    = trim($text_search, " ");
            $search_text    = str_replace(" ", "%", $search_text);

            $list_fields    = [];
            $list_params    = [];
            foreach ($fields as $val) {
                array_push($list_fields, " LIKE ? ");
                array_push($list_params, "%".$search_text."%");
            }

            $ret['clause']  = implode(" OR ", $list_fields);
            $ret['params']  = $list_params;

        } else {
            $ret['clause']  = $default_criteria;
            $ret['params']  = [];
        }

        return $ret;
    }

    protected function setInsert($data)
    {
        $ret    = [];
        $fields = [];
        $params = [];
        $value  = [];

        foreach ($data as $key => $val) {
            $fields[]        = $key;
            $params[]        = ":".$key;
            $value[":".$key] = $val;
        }

        $ret['fields']  = implode(",", $fields);
        $ret['params']  = implode(",", $params);
        $ret['value']   = $value;
    }

    protected function setUpdate($data, $clause)
    {
        $ret        = [];
        $data_set   = [];
        $data_val   = [];
        $data_where = [];

        foreach ($data as $key => $val) {
            $data_set[]          = $key . "=:".$key;
            $data_val[":".$key]  = $val; 
        }

        foreach ($clause as $key => $val) {
            $data_where[]       = $key . "=:".$val;
            $data_val[":".$key] = $val;
        }

        $data_where = implode(" and ", $data_where);

        $ret['data_set']    = implode(",", $data_set);
        $ret['data_where']  = $data_where;
        $ret['data_value']  = $data_val;
    }

    protected function setDelete($clause)
    {
        $ret            = [];
        $data_where     = [];
        $data_params    = [];

        foreach ($clause as $key => $val) {
            $data_where[]           = $key . "=:". $val;
            $data_params[":".$key]  = $val;
        }

        $ret['data_where']  = implode(" and ", $data_where);
        $ret['data_params'] = $data_params;
    }

    // SQL Statement Builder

    protected function get($table = null)
    {
        $select = $this->setSelect();
        $from   = $this->setFrom() !== null ? $this->setFrom() : $table;
        $where  = $this->setWhere();
        $orders = $this->setOrderBy() !== null ? $this->setOrderBy() : "";
        $limits = $this->setLimit() !== null ? $this->setLimit() : "";
        $groups = $this->setGroupBy() !== null ? $this->setGroupBy() : "";
        $sql    = "SELECT $select FROM $from WHERE $where $orders $limits $groups";
        $stmt   = $this->db->prepare($sql);
        $stmt->execute($this->params);

        return $stmt->fetchAll();
    }

    protected function insert($table, $data)
    {
        $data_set   = $this->setInsert($data);
        $sql        = "INSERT INTO $table (".$data_set['fields'].") VALUES (".$data_set['params'].") ";
        $stmt       = $this->db->prepare($sql);
        $exe        = $stmt->execute($data_set['value']);

        return $exe;
    }

    protected function update($table, $data, $clause)
    {
        $data_set   = $this->setUpdate($data, $clause);
        $sql        = "UPDATE $table SET ".$data_set['data_set']." WHERE ".$data_set['data_where'];
        $stmt       = $this->db->prepare($sql);
        $exe        = $stmt->execute($data_set['data_value']);

        return $exe;
    }

    protected function delete($table, $clause)
    {
        $data_set   = $this->setDelete($clause);
        $sql        = "DELETE FROM $table WHERE ".$data_set['data_where'];
        $stmt       = $this->db->prepare($sql);
        $exe        = $stmt->execute($data_set['data_params']);

        return $exe;
    }

}