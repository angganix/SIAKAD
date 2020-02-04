<?php

require_once "../config/init.php";
require_once "../model/Crud_basic.php";

$cls = new Crud_basic($db);

//Criteria clause
$act      = isset($_POST['act']) ? $_POST['act'] : "";
$offset   = isset($_POST['start']) ? $_POST['start'] : 0;
$perPage  = isset($_POST['length']) ? $_POST['length'] : 10;
$draw     = isset($_POST['draw']) ? $_POST['draw'] : 1;
$sortBy   = isset($_POST['order'][0]['column']) ? $_POST['order'][0]['column'] : 0;
$sortDir  = isset($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 'desc';
$criteria = isset($_POST['search']['value']) ? $_POST['search']['value'] : "1=1";

//Filter Section 
$filter_kelas = isset($_POST['filter_kelas']) ? $_POST['filter_kelas'] : "0";
$filter_ketunaan = isset($_POST['filter_ketunaan']) ? $_POST['filter_ketunaan'] : "0";
$filter_status = isset($_POST['filter_status']) ? $_POST['filter_status'] : "-";
$filter_tahun = isset($_POST['filter_tahun']) ? $_POST['filter_tahun'] : "";
$filter_criteria = "";

if($filter_kelas !== "0"){
    $filter_criteria .= " AND B.kelas=".$filter_kelas." ";
}

if($filter_ketunaan !== "0"){
    $filter_criteria .= " AND B.ketunaan=".$filter_ketunaan." ";
}

if($filter_status !== "-"){
    $filter_criteria .= " AND A.status=".$filter_status." ";
}

if($filter_tahun !== ""){
    $filter_criteria .= " AND A.tanggal_daftar LIKE '".$filter_tahun."%' ";
}


$fieldSort    = array("A.nomor_pendaftaran", "B.nama_siswa", "A.tanggal_daftar", "C.nama_ketunaan");
$fieldSearch  = array("A.nomor_pendaftaran", "B.nama_siswa", "A.tanggal_daftar", "C.nama_ketunaan");
$stringSearch = "";

//Konfigurasi klausa pencarian
if ($criteria !== "1=1") {
    
    $criteria = str_replace(" ", "%", $criteria);
    
    foreach ($fieldSearch as $val) {
        $stringSearch .= $val . " LIKE '%" . $criteria . "%' OR ";
    }
    
    $criteria = "AND ".substr($stringSearch, 0, -4);
}

//Tabel Siswa
$nik = isset($_POST['nik']) ? $_POST['nik'] : "";
$nama_siswa = isset($_POST['nama_lengkap']) ? cleanInput($_POST['nama_lengkap']) : "";
$ketunaan = isset($_POST['ketunaan']) ? $_POST['ketunaan'] : "0";
$alamat = isset($_POST['alamat']) ? cleanInput($_POST['alamat']) : "";
$rt_rw = isset($_POST['rt_rw']) ? cleanInput($_POST['rt_rw']) : "";
$kelurahan = isset($_POST['kelurahan']) ? cleanInput($_POST['kelurahan']) : "";
$kecamatan = isset($_POST['kecamatan']) ? cleanInput($_POST['kecamatan']) : "";
$kota = isset($_POST['kota']) ? cleanInput($_POST['kota']) : "";
$provinsi = isset($_POST['provinsi']) ? cleanInput($_POST['provinsi']) : "";
$kode_pos = isset($_POST['kode_pos']) ? cleanInput($_POST['kode_pos']) : "";
$tempat_lahir = isset($_POST['tempat_lahir']) ? cleanInput($_POST['tempat_lahir']) : "";
$tanggal_lahir = isset($_POST['tanggal_lahir']) ? cleanInput($_POST['tanggal_lahir']) : "";
$jenis_kelamin = isset($_POST['jenis_kelamin']) ? $_POST['jenis_kelamin'] : "l";
$agama = isset($_POST['agama']) ? $_POST['agama'] : "0";
$status_awal = "baru";
$status = "pendaftaran";
$jumlah_saudara = isset($_POST['jumlah_saudara']) ? $_POST['jumlah_saudara'] : 0;
$jumlah_saudara = $jumlah_saudara == "" ? 0 : $jumlah_saudara;
$anak_ke = isset($_POST['anak_ke']) ? $_POST['anak_ke'] : 1;
$anak_ke = $anak_ke == "" ? 0 : $anak_ke;
$hobi = isset($_POST['hobi']) ? $_POST['hobi'] : "";
$kelas = isset($_POST['kelas']) ? $_POST['kelas'] : "";

//Tabel Pendaftaran
$id = isset($_POST['id']) ? $_POST['id'] : "";
$tanggal_daftar = isset($_POST['tanggal_daftar']) ? $_POST['tanggal_daftar'] : date("Y-m-d");
$nama_panggilan = isset($_POST['nama_panggilan']) ? cleanInput($_POST['nama_panggilan']) : "";
$no_telpon = isset($_POST['no_telpon']) ? cleanInput($_POST['no_telpon']) : "";
$status_dalam_keluarga = isset($_POST['status_dalam_keluarga']) ? cleanInput($_POST['status_dalam_keluarga']) : "";
$olahraga_yang_digemari = isset($_POST['olahraga_yang_digemari']) ? cleanInput($_POST['olahraga_yang_digemari']) : "";
$alamat_ayah_ibu = isset($_POST['alamat_ayah_ibu']) ? cleanInput($_POST['alamat_ayah_ibu']) : "";
$gender_wali = isset($_POST['jenis_kelamin_wali']) ? cleanInput($_POST['jenis_kelamin_wali']) : "l";
$agama_wali = isset($_POST['agama_wali']) ? $_POST['agama_wali'] : "";
$alamat_wali = isset($_POST['alamat_wali']) ? $_POST['alamat_wali'] : "";
$status_daftar = isset($_POST['status_daftar']) ? $_POST['status_daftar'] : 2;

//Data Orang Tua
/* Data Ayah */
$nama_ayah = isset($_POST['nama_ayah']) ? cleanInput($_POST['nama_ayah']) : "";
$tempat_lahir_ayah = isset($_POST['tempat_lahir_ayah']) ? cleanInput($_POST['tempat_lahir_ayah']) : "";
$tanggal_lahir_ayah = isset($_POST['tanggal_lahir_ayah']) ? cleanInput($_POST['tanggal_lahir_ayah']) : "";
$pekerjaan_ayah = isset($_POST['pekerjaan_ayah']) ? cleanInput($_POST['pekerjaan_ayah']) : "";
$penghasilan_ayah = isset($_POST['penghasilan_ayah']) ? cleanInput($_POST['penghasilan_ayah']) : "";
$keadaan_ayah = isset($_POST['keadaan_ayah']) ? $_POST['keadaan_ayah'] : "";

/* Data Ibu */
$nama_ibu = isset($_POST['nama_ibu']) ? cleanInput($_POST['nama_ibu']) : "";
$tempat_lahir_ibu = isset($_POST['tempat_lahir_ibu']) ? cleanInput($_POST['tempat_lahir_ibu']) : "";
$tanggal_lahir_ibu = isset($_POST['tanggal_lahir_ibu']) ? cleanInput($_POST['tanggal_lahir_ibu']) : "";
$pekerjaan_ibu = isset($_POST['pekerjaan_ibu']) ? cleanInput($_POST['pekerjaan_ibu']) : "";
$penghasilan_ibu = isset($_POST['penghasilan_ibu']) ? cleanInput($_POST['penghasilan_ibu']) : "";
$keadaan_ibu = isset($_POST['keadaan_ibu']) ? $_POST['keadaan_ibu'] : "";

/* Data Wali */
$nama_wali = isset($_POST['nama_wali']) ? cleanInput($_POST['nama_wali']) : "";
$tempat_lahir_wali = isset($_POST['tempat_lahir_wali']) ? cleanInput($_POST['tempat_lahir_wali']) : "";
$tanggal_lahir_wali = isset($_POST['tanggal_lahir_wali']) ? cleanInput($_POST['tanggal_lahir_wali']) : "";
$pekerjaan_wali = isset($_POST['pekerjaan_wali']) ? cleanInput($_POST['pekerjaan_wali']) : "";
$penghasilan_wali = isset($_POST['penghasilan_wali']) ? cleanInput($_POST['penghasilan_wali']) : "";

//File Foto
$dir = "../upload/";
$foto_tmp = isset($_FILES['foto']['tmp_name']) ? $_FILES['foto']['tmp_name'] : "";
$foto_name = isset($_FILES['foto']['name']) ? cleanInput($_FILES['foto']['name']) : "";
$foto_size = isset($_FILES['foto']['size']) ? $_FILES['foto']['size'] : "";
$foto_ext = strtolower(pathinfo($foto_name, PATHINFO_EXTENSION));
$foto_allow_ext = array("jpg", "jpeg", "png", "gif");
$foto_upload = $nik . rand(9, 99) . "." . $foto_ext;

//Data Array Siswa
$data_array = array(
    "nik" => $nik,
    "nama_siswa" => $nama_siswa,
    "ketunaan" => $ketunaan,
    "alamat" => $alamat,
    "rt_rw" => $rt_rw,
    "kelurahan" => $kelurahan,
    "kecamatan" => $kecamatan,
    "kota" => $kota,
    "provinsi" => $provinsi,
    "kode_pos" => $kode_pos,
    "tempat_lahir" => $tempat_lahir,
    "tanggal_lahir" => $tanggal_lahir,
    "jenis_kelamin" => $jenis_kelamin,
    "agama" => $agama,
    "status_awal" => $status_awal,
    "status" => $status,
    "jumlah_saudara" => $jumlah_saudara,
    "anak_ke" => $anak_ke,
    "hobi" => $hobi,
    "foto" => "user.png",
    "kelas" => $kelas
);

//Data Array Ortu / Wali
$data_array_ortu = array(
    "siswa" => 0,
    "nama_ayah" => $nama_ayah,
    "tempat_lahir_ayah" => $tempat_lahir_ayah,
    "tanggal_lahir_ayah" => $tanggal_lahir_ayah,
    "pekerjaan_ayah" => $pekerjaan_ayah,
    "penghasilan_ayah" => $penghasilan_ayah,
    "keadaan_ayah" => $keadaan_ayah,
    "nama_ibu" => $nama_ibu,
    "tempat_lahir_ibu" => $tempat_lahir_ibu,
    "tanggal_lahir_ibu" => $tanggal_lahir_ibu,
    "pekerjaan_ibu" => $pekerjaan_ibu,
    "penghasilan_ibu" => $penghasilan_ibu,
    "keadaan_ibu" => $keadaan_ibu,
    "nama_wali" => $nama_wali,
    "tempat_lahir_wali" => $tempat_lahir_wali,
    "tanggal_lahir_wali" => $tanggal_lahir_wali,
    "pekerjaan_wali" => $pekerjaan_wali,
    "penghasilan_wali" => $penghasilan_wali,
);

//Data pendaftaran
$data_pendaftaran = array(
    "siswa" => 0,
    "tanggal_daftar" => $tanggal_daftar,
    "nama_panggilan" => $nama_panggilan,
    "no_telpon" => $no_telpon,
    "status_dalam_keluarga" => $status_dalam_keluarga,
    "olahraga_yang_digemari" => $olahraga_yang_digemari,
    "alamat_ayah_ibu" => $alamat_ayah_ibu,
    "gender_wali" => $gender_wali,
    "agama_wali" => $agama_wali,
    "alamat_wali" => $alamat_wali,
    "nomor_pendaftaran" => "PSB0",
    "status" => $status_daftar
);

if ($act == "getAll") {
    
    $query = $cls->getArray("A.id as id_daftar, A.nomor_pendaftaran, DATE_FORMAT(A.tanggal_daftar, '%Y') AS tahun_daftar, A.tanggal_daftar, A.nama_panggilan, A.status_dalam_keluarga, "
    . "A.no_telpon, A.olahraga_yang_digemari, A.alamat_ayah_ibu, A.gender_wali, A.agama_wali, A.alamat_wali, "
    . "B.nama_siswa, D.nama_kelas, C.kode_ketunaan, C.nama_ketunaan, A.status AS status_pendaftaran", "pendaftaran A "
    . "LEFT JOIN siswa B ON A.siswa = B.id "
    . "LEFT JOIN ketunaan C ON B.ketunaan = C.id "
    . "LEFT JOIN kelas D ON B.kelas = D.id", "(1=1 $criteria) $filter_criteria ORDER BY $fieldSort[$sortBy] $sortDir LIMIT $offset, $perPage ");
    
    $get_count = $cls->getCount("A.id as id_daftar, A.nomor_pendaftaran, A.tanggal_daftar, A.nama_panggilan, A.status_dalam_keluarga, "
    . "A.no_telpon, A.olahraga_yang_digemari, A.alamat_ayah_ibu, A.gender_wali, A.agama_wali, A.alamat_wali, "
    . "B.nama_siswa, C.kode_ketunaan, C.nama_ketunaan", "pendaftaran A "
    . "LEFT JOIN siswa B ON A.siswa = B.id "
    . "LEFT JOIN ketunaan C ON B.ketunaan = C.id ", "(1=1 $criteria) $filter_criteria ");
    
    $ret['data']            = $query;
    $ret['recordsTotal']    = intval($get_count['total_record']);
    $ret['recordsFiltered'] = intval($get_count['total_record']);
    $ret['draw']            = intval($draw);
    $ret['filter_criteria'] = $filter_criteria;
    
} elseif ($act == "getData") {
    $siswa_field = "(SELECT kode_ketunaan FROM ketunaan WHERE id=B.ketunaan) AS kode_ketunaan, ";
    $siswa_field .= "(SELECT nama_ketunaan FROM ketunaan WHERE id=B.ketunaan) AS nama_ketunaan ";
    $query = $cls->getArray("A.*, A.no_telpon AS no_dihubungi, B.*, " . $siswa_field, "pendaftaran A LEFT JOIN siswa B ON A.siswa = B.id", "A.id=" . $id);
    $get_siswa = $cls->getData("B.id","pendaftaran A LEFT JOIN siswa B ON A.siswa = B.id","A.id=".$id);
    
    $get_data_ortu = $cls->getArray("*", "data_orang_tua", "siswa=" . $get_siswa['id']);
    $cek_data_ortu = $cls->getCount("*", "data_orang_tua", "siswa=" . $get_siswa['id']);
    
    $ret['result'] = $query;
    
    //Data Ortu
    if ($cek_data_ortu['total_record'] > 0) {
        $ret['result_ortu'] = $get_data_ortu;
    } else {
        $ret['result_ortu'] = "kosong";
    }
} elseif ($act == "save") {
    
    if ($id == 0) {
        $cek = $cls->getCount("*", "siswa","nik='$nik'");
        if($cek['total_record'] < 1){
            if (!empty($_FILES['foto']['name'])) {
                if ($foto_size <= 2000000) {
                    if (in_array($foto_ext, $foto_allow_ext)) {
                        if (move_uploaded_file($foto_tmp, $dir . $foto_upload)) {
                            
                            $data_array['foto'] = $foto_upload;
                            $query = $cls->addNew("siswa", $data_array);
                            $getLast = $db->lastInsertId();
                            
                            $data_array_ortu['siswa'] = $getLast;
                            $data_pendaftaran['siswa'] = $getLast;
                            
                            
                            
                            $get_last_pendaftaran = $cls->getData("id","pendaftaran","1=1 ORDER BY id DESC LIMIT 1");
                            $next_daftar = $get_last_pendaftaran['id'] == null ? 0 : $get_last_pendaftaran['id'] + 1;
                            
                            $data_pendaftaran['nomor_pendaftaran'] = "PSB".$next_daftar;
                            $cls->addNew("data_orang_tua", $data_array_ortu);
                            $cls->addNew("pendaftaran", $data_pendaftaran);
                            
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
                $query = $cls->addNew("siswa", $data_array);
                $getLast = $db->lastInsertId();
                
                $get_last_pendaftaran = $cls->getData("id","pendaftaran","1=1 ORDER BY id DESC LIMIT 1");
                $next_daftar = $get_last_pendaftaran['id'] == null ? 0 : $get_last_pendaftaran['id'] + 1;
                
                $data_pendaftaran['nomor_pendaftaran'] = "PSB".$next_daftar;
                
                $data_array_ortu['siswa'] = $getLast;
                $data_pendaftaran['siswa'] = $getLast;
                
                $cls->addNew("data_orang_tua", $data_array_ortu);
                $cls->addNew("pendaftaran", $data_pendaftaran);
                
                if ($query) {
                    
                    $ret['status'] = true;
                    // $ret['status'] = $query;
                } else {
                    
                    $ret['status'] = false;
                    // $ret['status'] = $query;
                }
            }
        }else{
            $ret['status'] = "exists";
            // $get_id = $cls->getData("id","siswa","nik=".$nik);
            // $ret['id'] = $get_id['id'];
        }
    } else {
        
        if (empty($foto_name)) {
            $cls->del("data_orang_tua", "siswa=" . $id);
            $get_old_foto = $cls->getData("foto", "siswa", "id=" . $id);
            $old_foto = $get_old_foto['foto'];
            $data_array['foto'] = $old_foto;
            $query = $cls->update("siswa", $data_array, "id=" . $id);

            unset($data_pendaftaran['nomor_pendaftaran']);
            unset($data_pendaftaran['status']);
            
            $data_array_ortu['siswa'] = $id;
            $data_pendaftaran['siswa'] = $id;
            $query_update = $cls->addNew("data_orang_tua", $data_array_ortu);
            $update_pendaftaran = $cls->update("pendaftaran", $data_pendaftaran, "siswa=".$id);
            
            if ($query) {
                $ret['status_ortu'] = $query_update;
                $ret['status_pendaftaran'] = $update_pendaftaran;
                $ret['status'] = true;
            } else {
                
                $ret['status'] = false;
                $ret['gege'] = $query_update;
                $ret['geges'] = $update_pendaftaran;
            }
        } else {
            
            $get_old_foto = $cls->getData("foto", "siswa", "id=" . $id);
            $old_foto = $get_old_foto['foto'];
            if (file_exists($dir . $old_foto)) {
                unlink($dir . $old_foto);
            }
            
            
            if ($foto_size <= 2000000) {
                if (in_array($foto_ext, $foto_allow_ext)) {
                    if (move_uploaded_file($foto_tmp, $dir . $foto_upload)) {
                        $cls->del("data_orang_tua", "siswa=" . $id);
                        $data_array['foto'] = $foto_upload;
                        $query = $cls->update("siswa", $data_array, "id=" . $id);

                        unset($data_pendaftaran['nomor_pendaftaran']);
                        unset($data_pendaftaran['status']);
                        
                        $data_array_ortu['siswa'] = $id;
                        $data_pendaftaran['siswa'] = $id;
                        $cls->addNew("data_orang_tua", $data_array_ortu);
                        $cls->update("pendaftaran", $data_pendaftaran, "siswa=".$id);
                        
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
    $get_old_foto = $cls->getData("B.id, B.foto", "pendaftaran A LEFT JOIN siswa B ON A.siswa=B.id", "A.id=" . $id);
    $old_foto = $get_old_foto['foto'];
    $query = $cls->del("siswa", "id=" . $get_old_foto['id']);
    
    if ($query) {
        if ($old_foto !== "user.png") {
            unlink($dir . $old_foto);
        }
        $cls->del("data_orang_tua", "siswa=" . $get_old_foto['id']);
        $cls->del("pendaftaran", "siswa=".$get_old_foto['id']);
        $ret['status'] = true;
    } else {
        $ret['query'] = $get_old_foto;
        $ret['status'] = false;
    }
} elseif ($act == "getRelatedData") {
    
    $lst_kelas = $cls->getArray("*", "kelas", "1=1 AND status=1");
    $lst_tahun_akademik = $cls->getArray("*", "akademik", "1=1 AND status=1");
    $lst_ketunaan = $cls->getArray("*", "ketunaan", "1=1");
    $lst_agama = $cls->getArray("*", "agama", "1=1");
    $lst_status_awal = getEnum($db, "siswa", "status_awal");
    $lst_status = getEnum($db, "siswa", "status");
    $lst_jurusan = $cls->getArray("*", "jurusan", "1=1 AND status=1 ");
    $lst_semester = $cls->getArray("tahun_ajaran AS semester", "akademik", "1=1 AND status=1 GROUP BY tahun_ajaran ");
    $lst_keadaan_ayah = getEnum($db, "data_orang_tua", "keadaan_ayah");
    $lst_keadaan_ibu = getEnum($db, "data_orang_tua", "keadaan_ibu");
    
    $ret['lst_kelas'] = $lst_kelas;
    $ret['lst_tahun_akademik'] = $lst_tahun_akademik;
    $ret['lst_ketunaan'] = $lst_ketunaan;
    $ret['lst_agama'] = $lst_agama;
    $ret['lst_status_awal'] = $lst_status_awal;
    $ret['lst_status'] = $lst_status;
    $ret['lst_jurusan'] = $lst_jurusan;
    $ret['lst_semester'] = $lst_semester;
    $ret['lst_keadaan_ayah'] = $lst_keadaan_ayah;
    $ret['lst_keadaan_ibu'] = $lst_keadaan_ibu;
}elseif($act == "update_status"){
    $data_update = array(
        "status" => $status_daftar
    );
    $query = $cls->update("pendaftaran", $data_update, "id=".$id);
    
    if($query){
        $change_siswa = false;
        $get_siswa = $cls->getData("siswa", "pendaftaran", "id=".$id);
        
        if($status_daftar == 1){
            $update_siswa = array(
                "status_awal" => "baru",
                "status" => "aktif"
            );
            $change_siswa = $cls->update("siswa", $update_siswa, "id=".$get_siswa['siswa']);
        }elseif($status_daftar == 2){
            $update_siswa = array(
                "status_awal" => "",
                "status" => "pendaftaran"
            );
            $change_siswa = $cls->update("siswa", $update_siswa, "id=".$get_siswa['siswa']);
        }elseif($status_daftar == 0){
            $update_siswa = array(
                "status_awal" => "",
                "status" => ""
            );
            $change_siswa = $cls->update("siswa", $update_siswa, "id=".$get_siswa['siswa']);
        }
        
        $ret['status'] = $change_siswa; 
    }else{
        $ret['status'] = false;
    }
}

echo json_encode($ret);
