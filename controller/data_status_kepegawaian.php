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

$fieldSort    = array("status_kepegawaian", "keterangan");
$fieldSearch  = array("status_kepegawaian", "keterangan");
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
$status_kepegawaian = isset($_POST['status_kepegawaian']) ? cleanInput($_POST['status_kepegawaian']) : "";
$keterangan         = isset($_POST['keterangan']) ? cleanInput($_POST['keterangan']) : "";

$data_array = array(
    "status_kepegawaian" => $status_kepegawaian,
    "keterangan"         => $keterangan,
);

if ($act == "getAll") {

    $query     = $cls->getArray("*", "status_kepegawaian", "($criteria) ORDER BY $fieldSort[$sortBy] $sortDir LIMIT $offset, $perPage");
    $get_count = $cls->getCount("*", "status_kepegawaian", "($criteria)");

    $ret['data']            = $query;
    $ret['recordsTotal']    = intval($get_count['total_record']);
    $ret['recordsFiltered'] = intval($get_count['total_record']);
    $ret['draw']            = intval($draw);

} elseif ($act == "getData") {

    $query = $cls->getArray("*", "status_kepegawaian", "id=" . $id);

    $ret['result'] = $query;

} elseif ($act == "save") {

    if ($id == 0) {
        $query = $cls->addNew("status_kepegawaian", $data_array);
    } else {
        $query = $cls->update("status_kepegawaian", $data_array, "id=" . $id);
    }

    if ($query) {
        $ret['status'] = true;
    } else {
        $ret['status'] = false;
    }

} elseif ($act == "del") {

    $query = $cls->del("status_kepegawaian", "id=" . $id);

    if ($query) {
        $ret['status'] = true;
    } else {
        $ret['status'] = false;
    }

}

echo json_encode($ret);
