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

$fieldSort    = array("kode_jurusan", "nama_jurusan", "bidang_keahlian", "kompetensi_umum", "kompetensi_khusus", "status");
$fieldSearch  = array("kode_jurusan", "nama_jurusan", "bidang_keahlian", "kompetensi_umum", "kompetensi_khusus");
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
$id                = isset($_POST['id']) ? $_POST['id'] : "";
$kode_jurusan      = isset($_POST['kode_jurusan']) ? cleanInput($_POST['kode_jurusan']) : "";
$nama_jurusan      = isset($_POST['nama_jurusan']) ? cleanInput($_POST['nama_jurusan']) : "";
$bidang_keahlian   = isset($_POST['bidang_keahlian']) ? cleanInput($_POST['bidang_keahlian']) : "";
$kompetensi_umum   = isset($_POST['kompetensi_umum']) ? cleanInput($_POST['kompetensi_umum']) : "";
$kompetensi_khusus = isset($_POST['kompetensi_khusus']) ? cleanInput($_POST['kompetensi_khusus']) : "";
$pejabat           = isset($_POST['pejabat']) ? cleanInput($_POST['pejabat']) : "";
$jabatan           = isset($_POST['jabatan']) ? cleanInput($_POST['jabatan']) : "";
$keterangan        = isset($_POST['keterangan']) ? cleanInput($_POST['keterangan']) : "";
$status            = isset($_POST['status']) ? cleanInput($_POST['status']) : "";
$id_guru           = isset($_POST['id_guru']) ? $_POST['id_guru'] : "";

$data_array = array(
    "kode_jurusan"      => $kode_jurusan,
    "nama_jurusan"      => $nama_jurusan,
    "bidang_keahlian"   => $bidang_keahlian,
    "kompetensi_umum"   => $kompetensi_umum,
    "kompetensi_khusus" => $kompetensi_khusus,
    "pejabat"           => $pejabat,
    "jabatan"           => $jabatan,
    "keterangan"        => $keterangan,
    "status"            => $status,
    "id_guru"           => $id_guru,
);

if ($act == "getAll") {

    $query     = $cls->getArray("*", "jurusan", "($criteria) ORDER BY $fieldSort[$sortBy] $sortDir LIMIT $offset, $perPage");
    $get_count = $cls->getCount("*", "jurusan", "($criteria)");

    $ret['data']            = $query;
    $ret['recordsTotal']    = intval($get_count['total_record']);
    $ret['recordsFiltered'] = intval($get_count['total_record']);
    $ret['draw']            = intval($draw);

} elseif ($act == "getData") {

    $query = $cls->getArray("*", "jurusan", "id=" . $id);

    $ret['result'] = $query;

} elseif ($act == "save") {

    if ($id == 0) {
        $query = $cls->addNew("jurusan", $data_array);
    } else {
        $query = $cls->update("jurusan", $data_array, "id=" . $id);
    }

    if ($query) {
        $ret['status'] = true;
    } else {
        $ret['status'] = false;
    }

} elseif ($act == "del") {

    $query = $cls->del("jurusan", "id=" . $id);

    if ($query) {
        $ret['status'] = true;
    } else {
        $ret['status'] = false;
    }

} elseif ($act == "get_guru") {

    $query         = $cls->getArray("id, nrk, nama", "data_guru", "1=1");
    $ret['result'] = $query;

}

echo json_encode($ret);
