<?php
require_once "../config/init.php";
require_once "../model/Crud_basic.php";

$cls = new Crud_basic($db);

//Criteria clause
$act                   = isset($_POST['act']) ? $_POST['act'] : "";
$search_tahun_akademik = isset($_POST['tahun_akademik']) ? ($_POST['tahun_akademik'] == "0" ? "" : $_POST['tahun_akademik']) : "";
$search_kelas          = isset($_POST['kelas']) ? ($_POST['kelas'] == "0" ? "" : $_POST['kelas']) : "";
$search_status         = isset($_POST['status']) ? ($_POST['status'] == "0" ? "" : $_POST['status']) : "";
$criteria_search       = isset($_POST['criteria']) ? $_POST['criteria'] : "1=1";

//Pagination
$cur_page = isset($_POST['cur_page']) ? intval($_POST['cur_page']) : 1;
$per_page = 25;
$offset   = ($cur_page - 1) * $per_page;

//Konfigurasi klausa pencarian
$stt_search = "";
$thn_search = "";
$kls_search = "";

if ($search_status !== "") {
    $stt_search = "AND A.status='" . $search_status . "' ";
}
if ($search_tahun_akademik !== "") {
    $thn_search = "AND B.tahun_ajaran LIKE '" . $search_tahun_akademik . "%' ";
}
if ($search_kelas !== "") {
    $kls_search = "AND A.kelas='" . $search_kelas . "' ";
}

//Search by nama dan kode ketunaan
$fieldSearch  = array("A.nisn", "A.nama_siswa", "kode_ketunaan");
$stringSearch = "";

if ($criteria_search !== "1=1") {

    $criteria_search = str_replace(" ", "%", $criteria_search);

    foreach ($fieldSearch as $val) {
        $stringSearch .= $val . " LIKE '%" . $criteria_search . "%' OR ";
    }

    $criteria_search = substr($stringSearch, 0, -4);

}

$criteria = $stt_search . $thn_search . $kls_search . " AND (" . $criteria_search . ")";

//Add, Update, Delete
$id                = isset($_POST['id']) ? $_POST['id'] : "";
$nis               = isset($_POST['nis']) ? $_POST['nis'] : "";
$nisn              = isset($_POST['nisn']) ? $_POST['nisn'] : "";
$nik               = isset($_POST['nik']) ? $_POST['nik'] : "";
$nama_siswa        = isset($_POST['nama_siswa']) ? cleanInput($_POST['nama_siswa']) : "";
$kelas             = isset($_POST['kelas']) ? $_POST['kelas'] : "0";
$tahun_akademik    = isset($_POST['tahun_akademik']) ? $_POST['tahun_akademik'] : "0";
$ketunaan          = isset($_POST['ketunaan']) ? $_POST['ketunaan'] : "0";
$jurusan           = isset($_POST['jurusan']) ? $_POST['jurusan'] : "0";
$alamat            = isset($_POST['alamat']) ? cleanInput($_POST['alamat']) : "";
$rt_rw             = isset($_POST['rt_rw']) ? cleanInput($_POST['rt_rw']) : "";
$kelurahan         = isset($_POST['kelurahan']) ? cleanInput($_POST['kelurahan']) : "";
$kecamatan         = isset($_POST['kecamatan']) ? cleanInput($_POST['kecamatan']) : "";
$kota              = isset($_POST['kota']) ? cleanInput($_POST['kota']) : "";
$provinsi          = isset($_POST['provinsi']) ? cleanInput($_POST['provinsi']) : "";
$kode_pos          = isset($_POST['kode_pos']) ? cleanInput($_POST['kode_pos']) : "";
$tempat_lahir      = isset($_POST['tempat_lahir']) ? cleanInput($_POST['tempat_lahir']) : "";
$tanggal_lahir     = isset($_POST['tanggal_lahir']) ? cleanInput($_POST['tanggal_lahir']) : "";
$jenis_kelamin     = isset($_POST['jenis_kelamin']) ? $_POST['jenis_kelamin'] : "l";
$agama             = isset($_POST['agama']) ? $_POST['agama'] : "0";
$jenis_tinggal     = isset($_POST['jenis_tinggal']) ? cleanInput($_POST['jenis_tinggal']) : "";
$no_telpon         = isset($_POST['no_telpon']) ? cleanInput($_POST['no_telpon']) : "";
$no_hp             = isset($_POST['no_hp']) ? cleanInput($_POST['no_hp']) : "";
$email             = isset($_POST['email']) ? cleanInput($_POST['email']) : "";
$status_awal       = isset($_POST['status_awal']) ? $_POST['status_awal'] : "baru";
$asal_sekolah      = isset($_POST['asal_sekolah']) ? cleanInput($_POST['asal_sekolah']) : "";
$status            = isset($_POST['status']) ? $_POST['status'] : "aktif";
$status            = ($status == "" OR $status == "0") ? "aktif" : $status;
$keterangan_status = isset($_POST['keterangan_status']) ? cleanInput($_POST['keterangan_status']) : "";
$jumlah_saudara    = isset($_POST['jumlah_saudara']) ? $_POST['jumlah_saudara'] : 0;
$jumlah_saudara    = $jumlah_saudara == "" ? 0 : $jumlah_saudara;
$anak_ke           = isset($_POST['anak_ke']) ? $_POST['anak_ke'] : 1;
$anak_ke           = $anak_ke == "" ? 0 : $anak_ke;
$hobi              = isset($_POST['hobi']) ? $_POST['hobi'] : "";

//Data Orang Tua
/*Data Ayah*/
$nama_ayah          = isset($_POST['nama_ayah']) ? cleanInput($_POST['nama_ayah']) : "";
$tempat_lahir_ayah  = isset($_POST['tempat_lahir_ayah']) ? cleanInput($_POST['tempat_lahir_ayah']) : "";
$tanggal_lahir_ayah = isset($_POST['tanggal_lahir_ayah']) ? cleanInput($_POST['tanggal_lahir_ayah']) : "";
$pendidikan_ayah    = isset($_POST['pendidikan_ayah']) ? cleanInput($_POST['pendidikan_ayah']) : "";
$pekerjaan_ayah     = isset($_POST['pekerjaan_ayah']) ? cleanInput($_POST['pekerjaan_ayah']) : "";
$penghasilan_ayah   = isset($_POST['penghasilan_ayah']) ? cleanInput($_POST['penghasilan_ayah']) : "";
$no_telpon_ayah     = isset($_POST['no_telpon_ayah']) ? cleanInput($_POST['no_telpon_ayah']) : "";
$keadaan_ayah       = isset($_POST['keadaan_ayah']) ? $_POST['keadaan_ayah'] : "";

/*Data Ibu*/
$nama_ibu          = isset($_POST['nama_ibu']) ? cleanInput($_POST['nama_ibu']) : "";
$tempat_lahir_ibu  = isset($_POST['tempat_lahir_ibu']) ? cleanInput($_POST['tempat_lahir_ibu']) : "";
$tanggal_lahir_ibu = isset($_POST['tanggal_lahir_ibu']) ? cleanInput($_POST['tanggal_lahir_ibu']) : "";
$pendidikan_ibu    = isset($_POST['pendidikan_ibu']) ? cleanInput($_POST['pendidikan_ibu']) : "";
$pekerjaan_ibu     = isset($_POST['pekerjaan_ibu']) ? cleanInput($_POST['pekerjaan_ibu']) : "";
$penghasilan_ibu   = isset($_POST['penghasilan_ibu']) ? cleanInput($_POST['penghasilan_ibu']) : "";
$no_telpon_ibu     = isset($_POST['no_telpon_ibu']) ? cleanInput($_POST['no_telpon_ibu']) : "";
$keadaan_ibu       = isset($_POST['keadaan_ibu']) ? $_POST['keadaan_ibu'] : "";

/*Data Wali*/
$nama_wali          = isset($_POST['nama_wali']) ? cleanInput($_POST['nama_wali']) : "";
$tempat_lahir_wali  = isset($_POST['tempat_lahir_wali']) ? cleanInput($_POST['tempat_lahir_wali']) : "";
$tanggal_lahir_wali = isset($_POST['tanggal_lahir_wali']) ? cleanInput($_POST['tanggal_lahir_wali']) : "";
$pendidikan_wali    = isset($_POST['pendidikan_wali']) ? cleanInput($_POST['pendidikan_wali']) : "";
$pekerjaan_wali     = isset($_POST['pekerjaan_wali']) ? cleanInput($_POST['pekerjaan_wali']) : "";
$penghasilan_wali   = isset($_POST['penghasilan_wali']) ? cleanInput($_POST['penghasilan_wali']) : "";
$no_telpon_wali     = isset($_POST['no_telpon_wali']) ? cleanInput($_POST['no_telpon_wali']) : "";

//File Foto
$dir            = "../upload/";
$foto_tmp       = isset($_FILES['foto']['tmp_name']) ? $_FILES['foto']['tmp_name'] : "";
$foto_name      = isset($_FILES['foto']['name']) ? cleanInput($_FILES['foto']['name']) : "";
$foto_size      = isset($_FILES['foto']['size']) ? $_FILES['foto']['size'] : "";
$foto_ext       = strtolower(pathinfo($foto_name, PATHINFO_EXTENSION));
$foto_allow_ext = array("jpg", "jpeg", "png", "gif");
$foto_upload    = $nisn . rand(9, 99) . "." . $foto_ext;

//Data Array Siswa
$data_array = array(
    "nis"               => $nis,
    "nisn"              => $nisn,
    "nik"               => $nik,
    "nama_siswa"        => $nama_siswa,
    "kelas"             => $kelas,
    "tahun_akademik"    => $tahun_akademik,
    "ketunaan"          => $ketunaan,
    "jurusan"           => $jurusan,
    "alamat"            => $alamat,
    "rt_rw"             => $rt_rw,
    "kelurahan"         => $kelurahan,
    "kecamatan"         => $kecamatan,
    "kota"              => $kota,
    "provinsi"          => $provinsi,
    "kode_pos"          => $kode_pos,
    "tempat_lahir"      => $tempat_lahir,
    "tanggal_lahir"     => $tanggal_lahir,
    "jenis_kelamin"     => $jenis_kelamin,
    "agama"             => $agama,
    "jenis_tinggal"     => $jenis_tinggal,
    "no_telpon"         => $no_telpon,
    "no_hp"             => $no_hp,
    "email"             => $email,
    "status_awal"       => $status_awal,
    "asal_sekolah"      => $asal_sekolah,
    "status"            => $status,
    "keterangan_status" => $keterangan_status,
    "jumlah_saudara"    => $jumlah_saudara,
    "anak_ke"           => $anak_ke,
    "hobi"              => $hobi,
    "foto"              => "user.png",
);

//Data Array Ortu / Wali
$data_array_ortu = array(
    "siswa"              => 0,
    "nama_ayah"          => $nama_ayah,
    "tempat_lahir_ayah"  => $tempat_lahir_ayah,
    "tanggal_lahir_ayah" => $tanggal_lahir_ayah,
    "pendidikan_ayah"    => $pendidikan_ayah,
    "pekerjaan_ayah"     => $pekerjaan_ayah,
    "penghasilan_ayah"   => $penghasilan_ayah,
    "no_telpon_ayah"     => $no_telpon_ayah,
    "keadaan_ayah"       => $keadaan_ayah,
    "nama_ibu"           => $nama_ibu,
    "tempat_lahir_ibu"   => $tempat_lahir_ibu,
    "tanggal_lahir_ibu"  => $tanggal_lahir_ibu,
    "pendidikan_ibu"     => $pendidikan_ibu,
    "pekerjaan_ibu"      => $pekerjaan_ibu,
    "penghasilan_ibu"    => $penghasilan_ibu,
    "no_telpon_ibu"      => $no_telpon_ibu,
    "keadaan_ibu"        => $keadaan_ibu,
    "nama_wali"          => $nama_wali,
    "tempat_lahir_wali"  => $tempat_lahir_wali,
    "tanggal_lahir_wali" => $tanggal_lahir_wali,
    "pendidikan_wali"    => $pendidikan_wali,
    "pekerjaan_wali"     => $pekerjaan_wali,
    "penghasilan_wali"   => $penghasilan_wali,
    "no_telpon_wali"     => $no_telpon_wali,
);

//Config TTD
$ttd_tanggal       = isset($_POST['ttd_tanggal']) ? ($_POST['ttd_tanggal'] == "" ? "null" : $_POST['ttd_tanggal']) : "null";
$ttd_nama          = isset($_POST['ttd_nama']) ? $_POST['ttd_nama'] : "";
$ttd_nip           = isset($_POST['ttd_nip']) ? $_POST['ttd_nip'] : "";
$array_config_data = $ttd_tanggal . "|" . $ttd_nama . "|" . $ttd_nip;

$array_config = array(
    "array_value" => $array_config_data,
);

if ($act == "getAll") {

    $query = $cls->getArray("A.id as id_siswa, A.nisn, A.nama_siswa, B.tahun_ajaran, C.kode_ketunaan, D.nama_kelas, E.kode_jurusan, E.nama_jurusan ", "siswa A "
        . "LEFT JOIN akademik B ON A.tahun_akademik = B.id "
        . "LEFT JOIN ketunaan C ON A.ketunaan = C.id "
        . "LEFT JOIN kelas D ON A.kelas = D.id "
        . "LEFT JOIN jurusan E ON A.jurusan = E.id ", "(1=1 $criteria) ORDER BY A.nama_siswa ASC LIMIT $offset, $per_page ");

    $get_count = $cls->getCount("A.nisn, A.nama_siswa, B.tahun_ajaran, C.kode_ketunaan, D.nama_kelas, E.kode_jurusan, E.nama_jurusan", "siswa A "
        . "LEFT JOIN akademik B ON A.tahun_akademik = B.id "
        . "LEFT JOIN ketunaan C ON A.ketunaan = C.id "
        . "LEFT JOIN kelas D ON A.kelas = D.id "
        . "LEFT JOIN jurusan E ON A.jurusan = E.id ", "(1=1 $criteria)");

    $ret['result']       = $query;
    $ret['cur_page']     = $cur_page;
    $ret['max_page']     = ceil($get_count['total_record'] / $per_page);
    $ret['total_record'] = $get_count['total_record'];

} elseif ($act == "getData") {

    $siswa_field = "(SELECT nama_kelas FROM kelas WHERE id=siswa.kelas) AS nama_kelas, ";
    $siswa_field .= "(SELECT semester FROM akademik WHERE id=siswa.tahun_akademik) AS semester, ";
    $siswa_field .= "(SELECT kode_ketunaan FROM ketunaan WHERE id=siswa.ketunaan) AS kode_ketunaan, ";
    $siswa_field .= "(SELECT nama_ketunaan FROM ketunaan WHERE id=siswa.ketunaan) AS nama_ketunaan, ";
    $siswa_field .= "(SELECT agama FROM agama WHERE id=siswa.agama) AS agama, ";
    $siswa_field .= "(SELECT kode_jurusan FROM jurusan WHERE id=siswa.jurusan) AS kode_jurusan, ";
    $siswa_field .= "(SELECT nama_jurusan FROM jurusan WHERE id=siswa.jurusan) AS nama_jurusan ";

    $query         = $cls->getArray("*, siswa.agama AS agama_id, " . $siswa_field, "siswa", "id=" . $id);
    $get_data_ortu = $cls->getArray("*", "data_orang_tua", "siswa=" . $id);
    $cek_data_ortu = $cls->getCount("*", "data_orang_tua", "siswa=".$id);

    $ret['result']      = $query;

    //Data Ortu
    if($cek_data_ortu['total_record'] > 0){
        $ret['result_ortu'] = $get_data_ortu;
    }else{
        $ret['result_ortu'] = "kosong";
    }
    

} elseif ($act == "save") {

    if ($id == 0) {

        if (!empty($_FILES['foto']['name'])) {
            if ($foto_size <= 2000000) {
                if (in_array($foto_ext, $foto_allow_ext)) {
                    if (move_uploaded_file($foto_tmp, $dir . $foto_upload)) {

                        $data_array['foto'] = $foto_upload;
                        $query              = $cls->addNew("siswa", $data_array);
                        $getLast            = $db->lastInsertId();

                        $data_array_ortu['siswa'] = $getLast;
                        $cls->addNew("data_orang_tua", $data_array_ortu);

                        if ($query) {

                            $ret['status'] = true;
                            $ret['status'] = $query;

                        } else {

                            $ret['status'] = false;
                            $ret['status'] = $query;

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
            $query              = $cls->addNew("siswa", $data_array);
            $getLast            = $db->lastInsertId();

            $data_array_ortu['siswa'] = $getLast;
            $cls->addNew("data_orang_tua", $data_array_ortu);

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
            $cls->del("data_orang_tua", "siswa=" . $id);
            $get_old_foto             = $cls->getData("foto", "siswa", "id=" . $id);
            $old_foto                 = $get_old_foto['foto'];
            $data_array['foto']       = $old_foto;
            $query                    = $cls->update("siswa", $data_array, "id=" . $id);

            $data_array_ortu['siswa'] = $id;
            $query_update = $cls->addNew("data_orang_tua", $data_array_ortu);

            if ($query) {
                $ret['status_ortu'] = $query_update;
                $ret['status'] = true;

            } else {

                $ret['status'] = false;
                $ret['gege'] = $query_update;

            }

        } else {

            $get_old_foto = $cls->getData("foto", "siswa", "id=" . $id);
            $old_foto     = $get_old_foto['foto'];
            if(file_exists($dir.$old_foto)){
                unlink($dir . $old_foto);
            }
            

            if ($foto_size <= 2000000) {
                if (in_array($foto_ext, $foto_allow_ext)) {
                    if (move_uploaded_file($foto_tmp, $dir . $foto_upload)) {
                        $cls->del("data_orang_tua", "siswa=" . $id);
                        $data_array['foto']       = $foto_upload;
                        $query                    = $cls->update("siswa", $data_array, "id=" . $id);
                        
                        $data_array_ortu['siswa'] = $id;
                        $cls->addNew("data_orang_tua", $data_array_ortu);

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

    $get_old_foto = $cls->getData("foto", "siswa", "id=" . $id);
    $old_foto     = $get_old_foto['foto'];
    $query        = $cls->del("siswa", "id=" . $id);

    if ($query) {
        if ($old_foto !== "user.png") {
            unlink($dir . $old_foto);
        }
        $cls->del("data_orang_tua", "siswa=" . $id);
        $ret['status'] = true;
    } else {
        $ret['status'] = false;
    }

} elseif ($act == "getRelatedData") {

    $lst_kelas          = $cls->getArray("*", "kelas", "1=1 AND status=1");
    $lst_tahun_akademik = $cls->getArray("*", "akademik", "1=1 AND status=1");
    $lst_ketunaan       = $cls->getArray("*", "ketunaan", "1=1");
    $lst_agama          = $cls->getArray("*", "agama", "1=1");
    $lst_status_awal    = getEnum($db, "siswa", "status_awal");
    $lst_status         = getEnum($db, "siswa", "status");
    $lst_jurusan        = $cls->getArray("*", "jurusan", "1=1 AND status=1 ");
    $lst_semester       = $cls->getArray("tahun_ajaran AS semester", "akademik", "1=1 AND status=1 GROUP BY tahun_ajaran ");
    $lst_keadaan_ayah   = getEnum($db, "data_orang_tua", "keadaan_ayah");
    $lst_keadaan_ibu    = getEnum($db, "data_orang_tua", "keadaan_ibu");

    $ret['lst_kelas']          = $lst_kelas;
    $ret['lst_tahun_akademik'] = $lst_tahun_akademik;
    $ret['lst_ketunaan']       = $lst_ketunaan;
    $ret['lst_agama']          = $lst_agama;
    $ret['lst_status_awal']    = $lst_status_awal;
    $ret['lst_status']         = $lst_status;
    $ret['lst_jurusan']        = $lst_jurusan;
    $ret['lst_semester']       = $lst_semester;
    $ret['lst_keadaan_ayah']   = $lst_keadaan_ayah;
    $ret['lst_keadaan_ibu']    = $lst_keadaan_ibu;

} elseif ($act == "get_config") {

    $query = $cls->getArray("*", "config", "type_config='ttd_data_siswa'");

    $ret['result'] = $query;

} elseif ($act == "save_config_ttd") {

    $query = $cls->update("config", $array_config, "type_config='ttd_data_siswa'");
    if ($query) {
        $ret['status'] = true;
    } else {
        $ret['status'] = false;
    }

}

echo json_encode($ret);
