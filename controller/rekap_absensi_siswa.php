<?php

require_once "../config/init.php";
require_once "../model/Crud_basic.php";
$cls = new Crud_basic($db);

$act = isset($_POST['act']) ? $_POST['act'] : "";
$kelas = isset($_POST['kelas']) ? $_POST['kelas'] : "";
$bulan = isset($_POST['bulan']) ? $_POST['bulan'] : "";
$ret = array();

if ($act == "getRelatedData") {
    $ret['lst_kelas'] = $cls->getArray("*", "kelas", "1=1 AND status=1");
} elseif ($act == "get_profil") {
    $get_user = $cls->getData("wali_kelas", "kelas", "id=$kelas");
    $tbl_select = "kelas.id, nama_kelas, kode_ketunaan, nama_ketunaan, nrk, nama ";
    $tbl_join = "kelas LEFT JOIN data_guru ON kelas.wali_kelas = data_guru.id LEFT JOIN ketunaan ON kelas.ketunaan = ketunaan.id ";
    $criteria = "kelas.wali_kelas=".$get_user['wali_kelas'];

    $get_profil = $cls->getArray($tbl_select, $tbl_join, $criteria);
    $ret['result'] = $get_profil;
}


echo json_encode($ret);
