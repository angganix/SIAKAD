<?php

require_once "../config/init.php";
require_once "../model/autoload.php";

$admin = new User($db);

//Group of Variable
$act            = isset($_POST['act']) ? $_POST['act'] : "";
$offset         = isset($_POST['start']) ? $_POST['start'] : 0;
$perPage        = isset($_POST['length']) ? $_POST['length'] : 10;
$draw           = isset($_POST['draw']) ? $_POST['draw'] : 1;
$sortBy         = isset($_POST['order'][0]['column']) ? $_POST['order'][0]['column'] : 0;
$sortDir        = isset($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 'desc';
$criteria       = isset($_POST['search']['value']) ? cleanInput($_POST['search']['value']) : "1=1";
$fieldSort      = array("username", "nama", "email", "no_telpon", "str_akses");
$fieldSearch    = array("username", "nama", "email", "no_telpon", "akses");

//Add, Update, Delete
$id         = isset($_POST['id']) ? (int) $_POST['id'] : "";
$username   = isset($_POST['username']) ? cleanInput($_POST['username']) : "";
$password   = isset($_POST['password']) ? $_POST['password'] : "";
$nama       = isset($_POST['nama']) ? cleanInput($_POST['nama']) : "";
$email      = isset($_POST['email']) ? cleanInput($_POST['email']) : "";
$no_telpon  = isset($_POST['no_telpon']) ? cleanInput($_POST['no_telpon']) : "";
$akses      = isset($_POST['akses']) ? (int) $_POST['akses'] : "";

if ($act == "getAll") {

    $set_search     = $admin->setSearch($fieldSearch, $criteria, "1=1");
    $admin->clause  = "(".$set_search['clause'].")";
    $admin->params  = $set_search['params'];
    $admin->sortby  = $fieldSort[$sortBy];
    $admin->sortdir = $sortDir;
    $admin->offset  = $offset;
    $admin->limit   = $perPage;

    $ret['data'] = $admin->getAll();
    $ret['recordsTotal'] = (int) $admin->getCount();
    $ret['recordsFiltered'] = (int) $admin->getCount();
    $ret['draw'] = (int) $draw;
    
} elseif ($act == "getData") {

    $admin->clause  = "id=:id";
    $admin->params  = [":id" => $id];
    $ret['result']  = $admin->getEdit();

} elseif ($act == "save") {

    $data_array = array(
        ":username"     => $username,
        ":password"     => password_hash($password, PASSWORD_DEFAULT),
        ":nama"         => $nama,
        ":email"        => $email,
        ":no_telpon"    => $no_telpon,
        ":akses"        => $akses,
    );

    $admin->clause  = "username=:username";
    $admin->params  = [":username" => $username];
    
    if ($id == 0) {
        $cek = (int) $admin->getCount();

        if ($cek > 0) {
            $query      = false;
            $ret['cek'] = "exists";
        } else {
            $admin->params  = $data_array;
            $ret['status']  = $admin->addData();
        }
    } else {
        if ($_POST['password'] == "") {

            unset($data_array[':password']);
            $data_array[":id"]  = $id;

            $admin->params  = $data_array;
            $ret['status']  = $admin->updateData($data_array);
        } else {
            $admin->params  = $data_array;
            $ret['status']  = $admin->updateData($data_array);
        }
    }

} elseif ($act == "del") {

    $admin->clause  = "id=:id";
    $admin->params  = [":id" => $id];
    $ret['status']  = $admin->deleteData();

} elseif ($act == "get_akses") {

    $akses = new Akses_role($db);
    $ret['result']  = $akses->getAkses();

}

echo json_encode($ret);
