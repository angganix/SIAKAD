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

$fieldSort    = array("nama_kurikulum","status");
$fieldSearch  = array("nama_kurikulum");
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
$id       = isset($_POST['id']) ? $_POST['id'] : "";
$nama_kurikulum = isset($_POST['nama_kurikulum']) ? cleanInput($_POST['nama_kurikulum']) : "";
$status = isset($_POST['status']) ? cleanInput($_POST['status']) : "";

$data_array = array(
    "nama_kurikulum" => $nama_kurikulum,
    "status" => $status
);

if ($act == "getAll") {

    $query     = $cls->getArray("*", "kurikulum", "($criteria) ORDER BY $fieldSort[$sortBy] $sortDir LIMIT $offset, $perPage");
    $get_count = $cls->getCount("*", "kurikulum", "($criteria)");

    $ret['data']            = $query;
    $ret['recordsTotal']    = intval($get_count['total_record']);
    $ret['recordsFiltered'] = intval($get_count['total_record']);
    $ret['draw']            = intval($draw);

} elseif ($act == "getData") {

    $query = $cls->getArray("*", "kurikulum", "id=" . $id);

    $ret['result'] = $query;

} elseif ($act == "save") {

    if ($id == 0) {
        $query = $cls->addNew("kurikulum", $data_array);
    } else {
        $query = $cls->update("kurikulum", $data_array, "id=" . $id);
    }

    if ($query) {
        $ret['status'] = true;
    } else {
        $ret['status'] = false;
    }

} elseif ($act == "del") {

    $query = $cls->del("kurikulum", "id=" . $id);

    if ($query) {
        $ret['status'] = true;
    } else {
        $ret['status'] = false;
    }

}

echo json_encode($ret);
