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

$fieldSort    = array("nip", "nama", "jenis_kelamin", "no_hp", "D.status_kepegawaian", "nama_ptk");
$fieldSearch  = array("nip", "nama", "jenis_kelamin", "no_hp", "D.status_kepegawaian", "nama_ptk");
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
$id                          = isset($_POST['id']) ? $_POST['id'] : "";
$nip                         = isset($_POST['nip']) ? $_POST['nip'] : "";
$nrk                         = isset($_POST['nrk']) ? $_POST['nrk'] : "";
$nrg                         = isset($_POST['nrg']) ? $_POST['nrg'] : "";
$nik                         = isset($_POST['nik']) ? $_POST['nik'] : "";
$nama                        = isset($_POST['nama']) ? cleanInput($_POST['nama']) : "";
$tempat_lahir                = isset($_POST['tempat_lahir']) ? cleanInput($_POST['tempat_lahir']) : "";
$tanggal_lahir               = isset($_POST['tanggal_lahir']) ? $_POST['tanggal_lahir'] : "";
$jenis_kelamin               = isset($_POST['jenis_kelamin']) ? $_POST['jenis_kelamin'] : "";
$agama                       = isset($_POST['agama']) ? $_POST['agama'] : 0;
$no_hp                       = isset($_POST['no_hp']) ? $_POST['no_hp'] : "";
$email                       = isset($_POST['email']) ? cleanInput($_POST['email']) : "";
$nuptk                       = isset($_POST['nuptk']) ? $_POST['nuptk'] : "";
$alamat                      = isset($_POST['alamat']) ? cleanInput($_POST['alamat']) : "";
$rt_rw                       = isset($_POST['rt_rw']) ? cleanInput($_POST['rt_rw']) : "";
$kelurahan                   = isset($_POST['kelurahan']) ? cleanInput($_POST['kelurahan']) : "";
$kecamatan                   = isset($_POST['kecamatan']) ? cleanInput($_POST['kecamatan']) : "";
$kota_kabupaten              = isset($_POST['kota_kabupaten']) ? cleanInput($_POST['kota_kabupaten']) : "";
$provinsi                    = isset($_POST['provinsi']) ? cleanInput($_POST['provinsi']) : "";
$kode_pos                    = isset($_POST['kode_pos']) ? $_POST['kode_pos'] : "";
$pendidikan_terakhir         = isset($_POST['pendidikan_terakhir']) ? cleanInput($_POST['pendidikan_terakhir']) : "";
$jurusan                     = isset($_POST['jurusan']) ? cleanInput($_POST['jurusan']) : "";
$tahun_lulus                 = isset($_POST['tahun_lulus']) ? $_POST['tahun_lulus'] : "";
$jenis_ptk                   = isset($_POST['jenis_ptk']) ? $_POST['jenis_ptk'] : 0;
$status_kepegawaian          = isset($_POST['status_kepegawaian']) ? $_POST['status_kepegawaian'] : 0;
$status_keaktifan            = isset($_POST['status_keaktifan']) ? $_POST['status_keaktifan'] : "aktif";
$skcpns                      = isset($_POST['skcpns']) ? cleanInput($_POST['skcpns']) : "";
$tanggal_cpns                = isset($_POST['tanggal_cpns']) ? $_POST['tanggal_cpns'] : "";
$skpns                       = isset($_POST['skpns']) ? cleanInput($_POST['skpns']) : "";
$tanggal_pns                 = isset($_POST['tanggal_pns']) ? $_POST['tanggal_pns'] : "";
$tanggal_golongan_terakhir   = isset($_POST['tanggal_golongan_terakhir']) ? $_POST['tanggal_golongan_terakhir'] : "";
$golongan                    = isset($_POST['golongan']) ? $_POST['golongan'] : 0;
$status_nikah                = isset($_POST['status_nikah']) ? $_POST['status_nikah'] : "belum";
$nama_suami_istri            = isset($_POST['nama_suami_istri']) ? cleanInput($_POST['nama_suami_istri']) : "";
$nama_ayah_kandung           = isset($_POST['nama_ayah_kandung']) ? cleanInput($_POST['nama_ayah_kandung']) : "";
$nama_ibu_kandung            = isset($_POST['nama_ibu_kandung']) ? cleanInput($_POST['nama_ibu_kandung']) : "";
$jenis_pekerjaan_suami_istri = isset($_POST['jenis_pekerjaan_suami_istri']) ? cleanInput($_POST['jenis_pekerjaan_suami_istri']) : "";
$npwp                        = isset($_POST['npwp']) ? cleanInput($_POST['npwp']) : "";

//File Foto
$dir            = "../upload/";
$foto_tmp       = isset($_FILES['foto']['tmp_name']) ? $_FILES['foto']['tmp_name'] : "";
$foto_name      = isset($_FILES['foto']['name']) ? cleanInput($_FILES['foto']['name']) : "";
$foto_size      = isset($_FILES['foto']['size']) ? $_FILES['foto']['size'] : "";
$foto_ext       = strtolower(pathinfo($foto_name, PATHINFO_EXTENSION));
$foto_allow_ext = array("jpg", "jpeg", "png", "gif");
$foto_upload    = "guru-" . $nip . rand(9, 99) . "." . $foto_ext;

$data_array = array(
    "nip"                         => $nip,
    "nrk"                         => $nrk,
    "nrg"                         => $nrg,
    "nik"                         => $nik,
    "nama"                        => $nama,
    "tempat_lahir"                => $tempat_lahir,
    "tanggal_lahir"               => $tanggal_lahir,
    "jenis_kelamin"               => $jenis_kelamin,
    "agama"                       => $agama,
    "no_hp"                       => $no_hp,
    "email"                       => $email,
    "nuptk"                       => $nuptk,
    "alamat"                      => $alamat,
    "rt_rw"                       => $rt_rw,
    "kelurahan"                   => $kelurahan,
    "kecamatan"                   => $kecamatan,
    "kota_kabupaten"              => $kota_kabupaten,
    "provinsi"                    => $provinsi,
    "kode_pos"                    => $kode_pos,
    "pendidikan_terakhir"         => $pendidikan_terakhir,
    "jurusan"                     => $jurusan,
    "tahun_lulus"                 => $tahun_lulus,
    "jenis_ptk"                   => $jenis_ptk,
    "status_kepegawaian"          => $status_kepegawaian,
    "status_keaktifan"            => $status_keaktifan,
    "skcpns"                      => $skcpns,
    "tanggal_cpns"                => $tanggal_cpns,
    "skpns"                       => $skpns,
    "tanggal_pns"                 => $tanggal_pns,
    "tanggal_golongan_terakhir"   => $tanggal_golongan_terakhir,
    "golongan"                    => $golongan,
    "status_nikah"                => $status_nikah,
    "nama_suami_istri"            => $nama_suami_istri,
    "nama_ayah_kandung"           => $nama_ayah_kandung,
    "nama_ibu_kandung"            => $nama_ibu_kandung,
    "jenis_pekerjaan_suami_istri" => $jenis_pekerjaan_suami_istri,
    "npwp"                        => $npwp,
    "foto"                        => "user.png",
);

if ($act == "getAll") {
    $tbl_select = "A.*, A.id AS id_guru, ";
    $tbl_select .= "B.agama AS agama_text, ";
    $tbl_select .= "A.agama AS agama_id, ";
    $tbl_select .= "C.nama_ptk, ";
    $tbl_select .= "D.status_kepegawaian AS status_kepegawaian_text, ";
    $tbl_select .= "E.nama_golongan AS golongan_text ";

    $tbl_join = "data_guru A LEFT JOIN agama B ON A.agama = B.id ";
    $tbl_join .= "LEFT JOIN jenis_ptk C ON A.jenis_ptk = C.id ";
    $tbl_join .= "LEFT JOIN status_kepegawaian D ON A.status_kepegawaian = D.id ";
    $tbl_join .= "LEFT JOIN data_golongan E ON A.golongan = E.id ";

    $query     = $cls->getArray($tbl_select, $tbl_join, "($criteria) ORDER BY $fieldSort[$sortBy] $sortDir LIMIT $offset, $perPage");
    $get_count = $cls->getCount($tbl_select, $tbl_join, "($criteria)");

    $ret['data']            = $query;
    $ret['recordsTotal']    = intval($get_count['total_record']);
    $ret['recordsFiltered'] = intval($get_count['total_record']);
    $ret['draw']            = intval($draw);

} elseif ($act == "getData") {
    $tbl_select = "A.*, A.id AS id_guru, ";
    $tbl_select .= "B.agama AS agama_text, ";
    $tbl_select .= "A.agama AS agama_id, ";
    $tbl_select .= "C.nama_ptk, ";
    $tbl_select .= "D.status_kepegawaian AS status_kepegawaian_text, ";
    $tbl_select .= "E.nama_golongan AS golongan_text ";

    $tbl_join = "data_guru A LEFT JOIN agama B ON A.agama = B.id ";
    $tbl_join .= "LEFT JOIN jenis_ptk C ON A.jenis_ptk = C.id ";
    $tbl_join .= "LEFT JOIN status_kepegawaian D ON A.status_kepegawaian = D.id ";
    $tbl_join .= "LEFT JOIN data_golongan E ON A.golongan = E.id ";

    $query = $cls->getArray($tbl_select, $tbl_join, "A.id=" . $id);

    $ret['result'] = $query;

} elseif ($act == "save") {

    if ($id == 0) {

        if (!empty($_FILES['foto']['name'])) {
            if ($foto_size <= 2000000) {
                if (in_array($foto_ext, $foto_allow_ext)) {
                    if (move_uploaded_file($foto_tmp, $dir . $foto_upload)) {

                        $data_array['foto'] = $foto_upload;
                        $query              = $cls->addNew("data_guru", $data_array);

                        if ($query) {

                            $ret['status'] = true;
                            // $ret['status'] = $query;

                        } else {

                            $ret['status'] = false;
                            // $ret['status'] = $query;

                        }

                    } else {

                        $ret['status'] = "failed_upload";

                    }
                } else {

                    $ret['status'] = "failed_extension";

                }

            } else {

                $ret['status'] = "failed_size";

            }
        } else {

            $data_array['foto'] = "user.png";
            $query              = $cls->addNew("data_guru", $data_array);

            if ($query) {

                $ret['status'] = true;
                // $ret['status'] = $query;

            } else {

                $ret['status'] = false;
                // $ret['status'] = $query;

            }

        }

    } else {

        if (empty($foto_name)) {

            $get_old_foto       = $cls->getData("foto", "data_guru", "id=" . $id);
            $old_foto           = $get_old_foto['foto'];
            $data_array['foto'] = $old_foto;
            $query              = $cls->update("data_guru", $data_array, "id=" . $id);

            if ($query) {

                $ret['status'] = true;

            } else {

                $ret['status'] = false;

            }

        } else {

            $get_old_foto = $cls->getData("foto", "data_guru", "id=" . $id);
            $old_foto     = $get_old_foto['foto'];
            if($old_foto !== "user.png"){
                unlink($dir . $old_foto);
            }
            

            if ($foto_size <= 2000000) {
                if (in_array($foto_ext, $foto_allow_ext)) {
                    if (move_uploaded_file($foto_tmp, $dir . $foto_upload)) {

                        $data_array['foto'] = $foto_upload;

                        $query = $cls->update("data_guru", $data_array, "id=" . $id);

                        if ($query) {

                            $ret['status'] = true;

                        } else {

                            $ret['status'] = false;

                        }

                    } else {

                        $ret['status'] = "failed_upload";

                    }
                } else {

                    $ret['status'] = "failed_extension";

                }

            } else {

                $ret['status'] = "failed_size";

            }

        }

    }

} elseif ($act == "del") {

    $get_old_foto = $cls->getData("foto", "data_guru", "id=" . $id);
    $old_foto     = $get_old_foto['foto'];
    $query        = $cls->del("data_guru", "id=" . $id);

    if ($query) {
        if ($old_foto['foto'] !== "user.png") {
            unlink($dir . $old_foto);
        }
        $ret['status'] = true;
    } else {
        $ret['status'] = false;
    }

} elseif ($act == "getRelatedData") {

    $lst_agama              = $cls->getArray("*", "agama", "1=1");
    $lst_ptk                = $cls->getArray("*", "jenis_ptk", "1=1");
    $lst_status_kepegawaian = $cls->getArray("*", "status_kepegawaian", "1=1");
    $lst_status_keaktifan   = getEnum($db, "data_guru", "status_keaktifan");
    $lst_golongan           = $cls->getArray("*", "data_golongan", "1=1");
    $lst_status_nikah       = getEnum($db, "data_guru", "status_nikah");

    $ret['lst_agama']              = $lst_agama;
    $ret['lst_ptk']                = $lst_ptk;
    $ret['lst_status_kepegawaian'] = $lst_status_kepegawaian;
    $ret['lst_status_keaktifan']   = $lst_status_keaktifan;
    $ret['lst_golongan']           = $lst_golongan;
    $ret['lst_status_nikah']       = $lst_status_nikah;

}

echo json_encode($ret);
