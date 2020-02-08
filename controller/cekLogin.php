<?php
session_name("siakad");
require_once "../config/init.php";
require_once "../model/autoload.php";

$login  = new User($db);
$akses  = new Akses_role($db);

$username = isset($_POST['username']) ? cleanInput($_POST['username']) : "";
$password = isset($_POST['password']) ? cleanInput($_POST['password']) : "";

$login->clause  = "username=:username";
$login->params  = [":username" => $username];
$cekLogin = $login->cekLogin();

$ret = [];

if ($cekLogin['status'] === "not_found") {
    $ret['status']  = "not_exists";
} else {
    if (password_verify($password, $cekLogin['result']['password'])) {
        session_start();

        $result               = $cekLogin['result'];
        $_SESSION['id_user']  = $result['id'];
        $_SESSION['username'] = $result['username'];
        $_SESSION['fullname'] = $result['nama'];

        //Get Akses
        $_SESSION['akses_role'] = [];


        $akses->clause  = "id_role=:id_role";
        $akses->params  = [":id_role" => $result['akses']];
        $result_akses   = $akses->getAll();

        foreach ($result_akses['result'] as $val) {
            array_push($_SESSION['akses_role'], $val['role_akses']);
        }

        $ret['status'] = "completed";
    } else {
        $ret['status'] = "invalid_password";
        $ret['data']   = $cekLogin['result'];
    }
}

echo json_encode($ret);
