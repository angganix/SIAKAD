<?php

class Data_files{

  private $db;
  private $table = "files";
  private $fields = "(judul_file, nama_file, file_id, file_extension, time_add, time_updated)";
  public $id_files, $judul_file, $nama_file, $file_id, $file_extension, $time_add;
  public $criteria;

  public function __construct($db){
    $this->db = $db;
  }

  public function view(){

    $ret    = $array();
    $query  = "SELECT * FROM $this->table WHERE $this->criteria";
    $stmt   = $this->db->prepare($query);

    if($stmt->execute()){
      if($stmt->rowCount()){
        $ret['result'] = $stmt->fetchAll();
        $ret['status'] = true;
      }else{
        $ret['result'] = null;
        $ret['status'] = false;
      }
    }else{
      $ret['status']      = false;
      $ret['error_code']  = $this->db->errorInfo();
    }

    $ret['total_record']  = $stmt->rowCount();

    unset($stmt);
    return $ret;

  }

  public function add(){

    $data_value   = "'$this->judul_file',";
    $data_value  .= "'$this->nama_file',";
    $data_value  .= "'$this->file_id',";
    $data_value  .= "'$this->file_extension',";
    $data_value  .= "'$this->time_add'";

    $ret    = array();
    $query  = "INSERT INTO $this->table $this->fields VALUES($data_value) ";
    $stmt   = $this->db->prepare($query);

    if($stmt->execute()){
      $ret['status']      = true;
    }else{
      $ret['status']      = false;
      $ret['error_code']  = $this->db->errorInfo();
    }

    unset($stmt);
    return $ret;

  }

  public function update(){

    $data_value   = "judul_file='$this->judul_file',";
    $data_value  .= "nama_file='$this->nama_file',";
    $data_value  .= "file_id='$this->file_id',";
    $data_value  .= "file_extension='$this->file_extension'";

    $ret      = array();
    $query    = "UPDATE $this->table SET $data_value WHERE id_files=$this->id_files";
    $stmt     = $this->db->prepare($query);

    if($stmt->execute()){
      $ret['status']      = true;
    }else{
      $ret['status']      = false;
      $ret['error_code']  = $this->db->errorInfo();
    }

    unset($stmt);
    return $ret;

  }

  public function delete(){

    $ret      = array();
    $query    = "DELETE FROM $this->table WHERE id_files=$this->id_files";
    $stmt     = $this->db->prepare($query);

    if($stmt->execute()){
      $ret['status']      = true;
    }else{
      $ret['status']      = false;
      $ret['error_code']  = $this->db->errorInfo();
    }

    unset($stmt);
    return $ret;

  }


}
