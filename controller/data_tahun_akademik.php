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

$fieldSort    = array("kode_tahun", "semester", "tahun_ajaran", "status");
$fieldSearch  = array("kode_tahun", "semester", "tahun_ajaran", "status");
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
$id           = isset($_POST['id']) ? $_POST['id'] : "";
$kode_tahun   = isset($_POST['kode_tahun']) ? cleanInput($_POST['kode_tahun']) : "";
$semester     = isset($_POST['semester']) ? cleanInput($_POST['semester']) : "";
$tahun_ajaran = isset($_POST['tahun_ajaran']) ? cleanInput($_POST['tahun_ajaran']) : "";
$status       = isset($_POST['status']) ? $_POST['status'] : "";

$data_array = array(
    "kode_tahun"   => $kode_tahun,
    "semester"     => $semester,
    "tahun_ajaran" => $tahun_ajaran,
    "status"       => $status,
);

if ($act == "getAll") {

    $query     = $cls->getArray("*", "akademik", "($criteria) ORDER BY $fieldSort[$sortBy] $sortDir LIMIT $offset, $perPage");
    $get_count = $cls->getCount("*", "akademik", "($criteria)");

    $ret['data']            = $query;
    $ret['recordsTotal']    = intval($get_count['total_record']);
    $ret['recordsFiltered'] = intval($get_count['total_record']);
    $ret['draw']            = intval($draw);

} elseif ($act == "getData") {

    $query = $cls->getArray("*", "akademik", "id=" . $id);

    $ret['result'] = $query;

} elseif ($act == "save") {

    if ($id == 0) {
        $query = $cls->addNew("akademik", $data_array);
    } else {
        $query = $cls->update("akademik", $data_array, "id=" . $id);
    }

    if ($query) {
        $ret['status'] = true;
    } else {
        $ret['status'] = false;
    }

} elseif ($act == "del") {

    $query = $cls->del("akademik", "id=" . $id);

    if ($query) {
        $ret['status'] = true;
    } else {
        $ret['status'] = false;
    }

}

echo json_encode($ret);
