<?php
require_once "../config/init.php";
require_once "../model/Crud_basic.php";

$cls = new Crud_basic($db);

//Add, Update, Delete
$act            = isset($_POST['act']) ? $_POST['act'] : "";
$id             = isset($_POST['id']) ? $_POST['id'] : "";
$nama_sekolah   = isset($_POST['nama_sekolah']) ? cleanInput($_POST['nama_sekolah']) : "";
$npsn           = isset($_POST['npsn']) ? cleanInput($_POST['npsn']) : "";
$alamat         = isset($_POST['alamat']) ? cleanInput($_POST['alamat']) : "";
$kelurahan      = isset($_POST['kelurahan']) ? cleanInput($_POST['kelurahan']) : "";
$kecamatan      = isset($_POST['kecamatan']) ? cleanInput($_POST['kecamatan']) : "";
$kabupaten_kota = isset($_POST['kabupaten_kota']) ? cleanInput($_POST['kabupaten_kota']) : "";
$provinsi       = isset($_POST['provinsi']) ? cleanInput($_POST['provinsi']) : "";
$kode_pos       = isset($_POST['kode_pos']) ? cleanInput($_POST['kode_pos']) : "";
$no_telpon      = isset($_POST['no_telpon']) ? cleanInput($_POST['no_telpon']) : "";
$website        = isset($_POST['website']) ? cleanInput($_POST['website']) : "";
$email          = isset($_POST['email']) ? cleanInput($_POST['email']) : "";

$data_array = array(
    "nama_sekolah"   => $nama_sekolah,
    "npsn"           => $npsn,
    "alamat"         => $alamat,
    "kelurahan"      => $kelurahan,
    "kecamatan"      => $kecamatan,
    "kabupaten_kota" => $kabupaten_kota,
    "provinsi"       => $provinsi,
    "kode_pos"       => $kode_pos,
    "no_telpon"      => $no_telpon,
    "website"        => $website,
    "email"          => $email,
);

if ($act == "getData") {

    $query = $cls->getArray("*", "identitas_sekolah", "id=" . $id);

    $ret['result'] = $query;

} elseif ($act == "save") {

    $query = $cls->update("identitas_sekolah", $data_array, "id=" . $id);

    if ($query) {
        $ret['status'] = true;
    } else {
        $ret['status'] = false;
    }

}

echo json_encode($ret);
