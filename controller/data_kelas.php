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

$fieldSort    = array("A.nama_kelas", "B.nama_wali_kelas", "C.kode_ketunaan", "A.status");
$fieldSearch  = array("A.nama_kelas", "B.nama", "C.kode_ketunaan", "A.status");
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
$id         = isset($_POST['id']) ? $_POST['id'] : "";
$nama_kelas = isset($_POST['nama_kelas']) ? cleanInput($_POST['nama_kelas']) : "";
$wali_kelas = isset($_POST['wali_kelas']) ? $_POST['wali_kelas'] : "";
$ketunaan   = isset($_POST['ketunaan']) ? $_POST['ketunaan'] : "";
$status     = isset($_POST['status']) ? $_POST['status'] : "";

$data_array = array(
    "nama_kelas" => $nama_kelas,
    "wali_kelas" => $wali_kelas,
    "ketunaan"   => $ketunaan,
    "status"     => $status,
);

if ($act == "getAll") {

    $query = $cls->getArray("A.id, A.nama_kelas, A.status, B.nama AS nama_wali_kelas, C.kode_ketunaan ", "kelas A LEFT JOIN data_guru B ON A.wali_kelas = B.id LEFT JOIN ketunaan C ON A.ketunaan = C.id ", "($criteria) ORDER BY $fieldSort[$sortBy] $sortDir LIMIT $offset, $perPage");

    $get_count = $cls->getCount("A.nama_kelas, A.status, B.nama AS nama_wali_kelas, C.kode_ketunaan ", "kelas A LEFT JOIN data_guru B ON A.wali_kelas = B.id LEFT JOIN ketunaan C ON A.ketunaan = C.id ","($criteria)");

    $ret['data']            = $query;
    $ret['recordsTotal']    = intval($get_count['total_record']);
    $ret['recordsFiltered'] = intval($get_count['total_record']);
    $ret['draw']            = intval($draw);

} elseif ($act == "getData") {

    $query = $cls->getArray("*", "kelas", "id=" . $id);

    $ret['result'] = $query;

} elseif ($act == "save") {

    if ($id == 0) {
        $query = $cls->addNew("kelas", $data_array);
    } else {
        $query = $cls->update("kelas", $data_array, "id=" . $id);
    }

    if ($query) {
        $ret['status'] = true;
    } else {
        $ret['status'] = false;
    }

} elseif ($act == "del") {

    $query = $cls->del("kelas", "id=" . $id);

    if ($query) {
        $ret['status'] = true;
    } else {
        $ret['status'] = false;
    }

}elseif($act == "getWaliKelas"){

    $query = $cls->getArray("*", "data_guru", "1=1");
    $ret['result'] = $query;

}elseif($act == "getKetunaan"){

    $query = $cls->getArray("*", "ketunaan", "1=1");
    $ret['result'] = $query;

}

echo json_encode($ret);
