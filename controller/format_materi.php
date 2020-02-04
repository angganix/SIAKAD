<?php
require_once "../config/init.php";
require_once "../model/Crud_basic.php";

$cls = new Crud_basic($db);

//Group of Variable
$act      = isset($_POST['act']) ? $_POST['act'] : "";
$offset   = isset($_POST['start']) ? $_POST['start'] : 0;
$perPage  = isset($_POST['length']) ? $_POST['length'] : 10;
$draw     = isset($_POST['draw']) ? $_POST['draw'] : 1;
$sortBy   = isset($_POST['order'][0]['column']) ? $_POST['order'][0]['column'] : 0;
$sortDir  = isset($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 'desc';
$criteria = isset($_POST['search']['value']) ? $_POST['search']['value'] : "1=1";

$fieldSort    = array("type","nama_format","format_value");
$fieldSearch  = array("type","nama_format","format_value");
$stringSearch = "";

//Konfigurasi klausa pencarian
if ($criteria !== "1=1") {

    $criteria = str_replace(" ", "%", $criteria);

    foreach ($fieldSearch as $val) {
        $stringSearch .= $val . " LIKE '%" . $criteria . "%' OR ";
    }

    $criteria = substr($stringSearch, 0, -4);
}

//Add, Update, Delete
$id                 = isset($_POST['id']) ? $_POST['id'] : "";
$nama_format        = isset($_POST['nama_format']) ? $_POST['nama_format'] : "";
$type               = isset($_POST['type']) ? $_POST['type'] : "";
$format_value       = isset($_POST['format_value']) ? $_POST['format_value'] : "";
if($type == "pilihan"){
  $format_value       = strtolower($format_value);
  $format_value       = str_replace(" ","", $format_value);
}


$data_array = array(
    "nama_format"   => $nama_format,
    "type"          => $type,
    "format_value"  => $format_value
);

if ($act == "getAll") {

    $query = $cls->getArray("id_format, type as tipe, nama_format, format_value", "format_pembelajaran", "($criteria) ORDER BY $fieldSort[$sortBy] $sortDir LIMIT $offset, $perPage");

    $get_count = $cls->getCount("*", "format_pembelajaran","($criteria)");

    $ret['data']            = $query;
    $ret['recordsTotal']    = intval($get_count['total_record']);
    $ret['recordsFiltered'] = intval($get_count['total_record']);
    $ret['draw']            = intval($draw);

} elseif ($act == "getData") {

    $query = $cls->getArray("id_format, type as tipe, nama_format, format_value", "format_pembelajaran", "id_format=" . $id);

    $ret['result'] = $query;

} elseif ($act == "save") {

    if ($id == 0) {
        $query = $cls->addNew("format_pembelajaran", $data_array);
    } else {
        $query = $cls->update("format_pembelajaran", $data_array, "id_format=" . $id);
    }

    if ($query) {
        $ret['status'] = true;
    } else {
        $ret['status'] = false;
    }

} elseif ($act == "del") {

    $query = $cls->del("format_pembelajaran", "id_format=" . $id);

    if ($query) {
        $ret['status'] = true;
    } else {
        $ret['status'] = false;
    }

}

echo json_encode($ret);
