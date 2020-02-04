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

$fieldSort    = array("username", "nama", "email", "no_telpon", "str_jabatan", "str_akses");
$fieldSearch  = array("username", "nama", "email", "no_telpon", "str_jabatan", "str_akses");
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
$id        = isset($_POST['id']) ? $_POST['id'] : "";
$username  = isset($_POST['username']) ? cleanInput($_POST['username']) : "";
$password  = isset($_POST['password']) ? md5(cleanInput($_POST['password'])) : "";
$nama      = isset($_POST['nama']) ? cleanInput($_POST['nama']) : "";
$email     = isset($_POST['email']) ? cleanInput($_POST['email']) : "";
$no_telpon = isset($_POST['no_telpon']) ? cleanInput($_POST['no_telpon']) : "";
$jabatan   = isset($_POST['jabatan']) ? $_POST['jabatan'] : "";
$akses     = isset($_POST['akses']) ? $_POST['akses'] : "";

$data_array = array(
    "username"  => $username,
    "password"  => $password,
    "nama"      => $nama,
    "email"     => $email,
    "no_telpon" => $no_telpon,
    "jabatan"   => $jabatan,
    "akses"     => $akses,
);

if ($act == "getAll") {

    $query     = $cls->getArray("*, (SELECT nama_ptk FROM jenis_ptk WHERE id=admin.jabatan) AS str_jabatan, (SELECT nama_role FROM role WHERE id=admin.akses) AS str_akses", "admin", "($criteria) ORDER BY $fieldSort[$sortBy] $sortDir LIMIT $offset, $perPage");
    $get_count = $cls->getCount("*", "admin", "($criteria)");

    $ret['data']            = $query;
    $ret['recordsTotal']    = intval($get_count['total_record']);
    $ret['recordsFiltered'] = intval($get_count['total_record']);
    $ret['draw']            = intval($draw);

} elseif ($act == "getData") {

    $query = $cls->getArray("*", "admin", "id=" . $id);

    $ret['result'] = $query;

} elseif ($act == "save") {

    if ($id == 0) {
        $query = $cls->addNew("admin", $data_array);
    } else {
        if ($password !== "") {
            $query = $cls->update("admin", $data_array, "id=" . $id);
        } else {

            $array_edit = array(
                "username"  => $username,
                "nama"      => $nama,
                "email"     => $email,
                "no_telpon" => $no_telpon,
                "jabatan"   => $jabatan,
                "akses"     => $akses,
            );

            $query = $cls->update("admin", $array_edit, "id=".$id);

        }

    }

    if ($query) {
        $ret['status'] = true;
    } else {
        $ret['status'] = false;
    }

} elseif ($act == "del") {

    $query = $cls->del("admin", "id=" . $id);

    if ($query) {
        $ret['status'] = true;
    } else {
        $ret['status'] = false;
    }

} elseif ($act == "get_jabatan") {

    $query         = $cls->getArray("*", "jenis_ptk", "($criteria)");
    $ret['result'] = $query;

} elseif ($act == "get_akses") {

    $query         = $cls->getArray("*", "role", "($criteria)");
    $ret['result'] = $query;

}

echo json_encode($ret);
