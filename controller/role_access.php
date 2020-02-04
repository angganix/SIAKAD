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

$fieldSort    = array("nama_role");
$fieldSearch  = array("nama_role");
$stringSearch = "";

//Konfigurasi klausa pencarian
if ($criteria !== "1=1") {

    $criteria = str_replace(" ", "%", $criteria);

    foreach ($fieldSearch as $val) {
        $stringSearch .= $val . " LIKE '%" . $criteria . "%' OR ";
    }

    $criteria = substr($stringSearch, 0, -4);
}

$id         = isset($_POST['id']) ? $_POST['id'] : "";
$nama_role  = isset($_POST['nama_role']) ? cleanInput($_POST['nama_role']) : "";
$role_akses = isset($_POST['role_akses']) ? $_POST['role_akses'] : "";

$data_array = array(
    "nama_role" => $nama_role,
);

if ($act == "getAll") {

    $query     = $cls->getArray("*", "role", "($criteria) ORDER BY $fieldSort[$sortBy] $sortDir LIMIT $offset, $perPage");
    $get_count = $cls->getCount("*", "role", "($criteria)");

    $ret['data']            = $query;
    $ret['recordsTotal']    = intval($get_count['total_record']);
    $ret['recordsFiltered'] = intval($get_count['total_record']);
    $ret['draw']            = intval($draw);

} elseif ($act == "getData") {

    $query = $cls->getArray("*", "role", "id=" . $id);
    $get_detail = $cls->getArray("*", "role_detail", "id_role=".$id);

    $ret['result'] = $query;
    $ret['detail_role'] = $get_detail;

} elseif ($act == "save") {

    if ($id == 0) {
        $query   = $cls->addNew("role", $data_array);
        $getLast = $db->lastInsertId();

        foreach ($role_akses as $list) {
            $array_detail = array(
                "id_role"    => $getLast,
                "role_akses" => $list['value'],
            );

            $cls->addNew("role_detail", $array_detail);
        }

    } else {
        $del_detail = $cls->del("role_detail", "id_role=" . $id);
        if ($del_detail) {
            $query = true;
            foreach ($role_akses as $list) {
                $array_detail = array(
                    "id_role"    => $id,
                    "role_akses" => $list['value'],
                );

                $cls->addNew("role_detail", $array_detail);
            }
        }
    }

    if ($query) {
        $ret['status'] = true;
    } else {
        $ret['status'] = false;
    }

} elseif ($act == "del") {

    $query = $cls->del("role", "id=" . $id);

    if ($query) {
        $cls->del("role_detail", "id_role=" . $id);
        $ret['status'] = true;
    } else {
        $ret['status'] = false;
    }

}

echo json_encode($ret);
