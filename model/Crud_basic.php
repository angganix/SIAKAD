<?php

class Crud_basic{
    private $db;

    function __construct($db){
        $this->db = $db;
    }

    function getArray($tbl_select, $tbl, $criteria){
        $query = "SELECT $tbl_select FROM $tbl WHERE $criteria";
        $stmt = $this->db->prepare($query);
        $ret = false;

        if($stmt->execute()){
            $ret = $stmt->fetchAll();
        }

        unset($stmt);

        return $ret;
        // return $query;
    }


    function getData($tbl_select, $tbl, $criteria){
        $query = "SELECT $tbl_select FROM $tbl WHERE $criteria";
        $stmt = $this->db->prepare($query);
        $ret = false;

        if($stmt->execute()){
            $ret = $stmt->fetch();
        }

        unset($stmt);

        return $ret;
        // return $query;
    }

    function getCount($tbl_select, $tbl, $criteria){
        $query = "SELECT COUNT(*) AS total_record FROM $tbl WHERE $criteria";
        $stmt = $this->db->prepare($query);
        $ret = false;

        if($stmt->execute()){
            $ret = $stmt->fetch();
        }

        unset($stmt);
        return $ret;
    }

    function addNew($tbl, $data){
        $list_field = array();
        $list_value = array();


        foreach($data as $key => $val){
            array_push($list_field, $key);

            if(is_string($val)){
                array_push($list_value, "{$this->db->quote($val)}");
            }else{
                array_push($list_value, $val);
            }
        }

        $list_field = implode(",", $list_field);
        $list_value = implode(", ", $list_value);


        $query = "INSERT INTO $tbl ($list_field) VALUES(".$list_value.") ";
        $stmt = $this->db->prepare($query);
        $ret = false;

        if($stmt->execute()){
            $ret = true;
        }

        unset($stmt);

        return $ret;
    //    return $query;

    }

    function del($tbl, $criteria){
        $query = "DELETE FROM $tbl WHERE $criteria";
        $stmt = $this->db->prepare($query);
        $ret = false;

        if($stmt->execute()){
            $ret = true;
        }

        unset($stmt);

        return $ret;
    }

    function update($tbl, $data, $criteria){

        $list_data = array();

        foreach($data as $key => $val){
            if(is_string($val)){
                array_push($list_data, $key."={$this->db->quote($val)}");
            }else{
                array_push($list_data, $key."=".$val);
            }
        }

        $list_data = implode(", ", $list_data);


        $query = "UPDATE $tbl SET $list_data WHERE $criteria ";
        $stmt = $this->db->prepare($query);
        $ret = false;

        if($stmt->execute()){
            $ret = true;
        }

        unset($stmt);

        return $ret;
        // return $query;
    }

}
