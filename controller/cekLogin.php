<?php
session_name("siakad");
require_once "../config/init.php";
require_once "../model/Crud_basic.php";

$cls = new Crud_basic($db);

$username = isset($_POST['username']) ? $_POST['username'] : "";
$password = isset($_POST['password']) ? md5($_POST['password']) : "";

$getData  = $cls->getData("*", "admin", " username='$username' AND password='$password' ");
$getCount = $cls->getCount("*", "admin", " username='$username' ");

$ret = array();

if ($getCount['total_record'] == 0) {
    $ret['status'] = "not_exists";
} else {
    if ($getData['username'] == "" or $getData['username'] == null) {
        $ret['status'] = "invalid_login";
    } else {
        session_start();
        
        $_SESSION['id_user']  = $getData['id'];
        $_SESSION['username'] = $getData['username'];
        $_SESSION['password'] = $getData['password'];
        $_SESSION['fullname'] = $getData['nama'];

        //Get Akses
        $_SESSION['akses_role'] = array();
        $get_akses = $cls->getArray("*","role_detail","id_role=".$getData['akses']);
        foreach($get_akses as $val){
            array_push($_SESSION['akses_role'], $val['role_akses']);
        }

        $ret['status'] = "completed";
    }
}

echo json_encode($ret);
