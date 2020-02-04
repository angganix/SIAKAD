<?php
session_name("siakad");
session_start();

require_once "../config/init.php";
require_once "../model/Crud_basic.php";

ini_set("display_errors", 1);


$cls = new Crud_basic($db);

//Display data from datatables
$offset   = isset($_POST['start']) ? $_POST['start'] : 0;
$perPage  = isset($_POST['length']) ? $_POST['length'] : 10;
$draw     = isset($_POST['draw']) ? $_POST['draw'] : 1;
$sortBy   = isset($_POST['order'][0]['column']) ? $_POST['order'][0]['column'] : 0;
$sortDir  = isset($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 'desc';
$criteria = isset($_POST['search']['value']) ? $_POST['search']['value'] : "1=1";

$fieldSort    = array("judul", "C.nama_kelas", "E.nama", "nama_jurusan", "last_edit", "is_ok");
$fieldSearch  = array("judul", "C.nama_kelas", "E.nama", "nama_jurusan", "last_edit", "is_ok");
$stringSearch = "";

//Konfigurasi klausa pencarian
if ($criteria !== "1=1") {

  $criteria = str_replace(" ", "%", $criteria);

  foreach ($fieldSearch as $val) {
    $stringSearch .= $val . " LIKE '%" . $criteria . "%' OR ";
  }

  $criteria = substr($stringSearch, 0, -4);
}

//Group of Variable
$act       = isset($_POST['act']) ? $_POST['act'] : "";
$id_user   = $_SESSION['id_user'];
$get_kelas = $cls->getData("id", "kelas", "wali_kelas=$id_user");
$kelas     = $get_kelas['id'];

$id                 = isset($_POST['id']) ? $_POST['id'] : "";
$judul              = isset($_POST['judul']) ? $_POST['judul'] : "";
$tahun_ajaran       = isset($_POST['tahun_ajaran']) ? $_POST['tahun_ajaran'] : 0;
$kurikulum          = 0;
$text_materi        = isset($_POST['text_materi']) ? $_POST['text_materi'] : "";
$id_format          = isset($_POST['id_format']) ? $_POST['id_format'] : "";
$id_jurusan         = isset($_POST['id_jurusan']) ? $_POST['id_jurusan'] : "";
$format_value_opsi  = isset($_POST['format_value_opsi']) ? $_POST['format_value_opsi'] : "";
$format_value_text  = isset($_POST['format_value_text']) ? $_POST['format_value_text'] : "";
$is_ok              = isset($_POST['is_ok']) ? $_POST['is_ok'] : "";
$status             = isset($_POST['status']) ? $_POST['status'] : "";
$kelas_bidang_studi = isset($_POST['kelas_bidang_studi']) ? $_POST['kelas_bidang_studi'] : "";
$file_path          = "../document/";

//Filter Group
$filter_jurusan   = "";
$filter_kelas     = "";
$filter_telaah    = "";
$filter_status    = " ";

if($id_jurusan !== "0" AND $id_jurusan !== ""){
  $filter_jurusan = "AND A.id_jurusan=".$id_jurusan;
}

if($is_ok !== "-"){
  $filter_telaah = "AND A.is_ok=".$is_ok;
}

if($status !== "-"){
  $filter_status = "AND A.status='".$status."'";
}

if($kelas_bidang_studi !== "0" AND $kelas_bidang_studi !== ""){
    $filter_kelas = "AND A.kelas_bidang_studi=".$kelas_bidang_studi;
}

//Format Judul
$get_format_judul   = $cls->getData("nama_format, type","format_pembelajaran","id_format=".$id_format);
$format_value       = $get_format_judul['type'] == "pilihan" ? $format_value_opsi : $format_value_text;
$format_judul       = $get_format_judul['nama_format'];
$judul              = $format_judul." - ".$format_value;

//File POST
$file_name = isset($_FILES['document']['name']) ? $_FILES['document']['name'] : "";
$file_tmp  = isset($_FILES['document']['tmp_name']) ? $_FILES['document']['tmp_name'] : "";
$file_size = isset($_FILES['document']['size']) ? $_FILES['document']['size'] : "";
$valid_ext = array("doc","docx","pptx","ppt","xls","xlsx");

if (!empty($_FILES['document']['name'])) {
    $file_ext     = pathinfo($file_name);
    $file_ext     = strtolower($file_ext['extension']);
    $file_new_name  = $judul."_".date("YmdHis")."." . $file_ext;
}


//Get Data
if ($act == "getAll") {
  $tbl_select = "A.is_ok, A.id, A.file_id, A.file_extension, A.judul, DATE_FORMAT(A.last_edit, '%d/%m/%Y') AS last_edit, ";
  $tbl_select .= "A.file, B.tahun_ajaran, E.nama AS wali_kelas, A.status, F.nama_jurusan, C.nama_kelas";

  $tbl_join = "pembelajaran A LEFT JOIN akademik B ON A.tahun_ajaran = B.id ";
  $tbl_join .= "LEFT JOIN jurusan F ON A.id_jurusan = F.id ";
  $tbl_join .= "LEFT JOIN data_guru E ON F.id_guru = E.id ";
  $tbl_join .= "LEFT JOIN kelas C ON A.kelas_bidang_studi = C.id ";

  $query     = $cls->getArray($tbl_select, $tbl_join, "($criteria) AND A.id_jurusan != 0 $filter_jurusan $filter_telaah $filter_status $filter_kelas ORDER BY $fieldSort[$sortBy] $sortDir LIMIT $offset, $perPage");
  $get_count = $cls->getCount($tbl_select, $tbl_join, "($criteria) AND A.id_jurusan != 0 $filter_jurusan $filter_telaah $filter_status $filter_kelas");

  $ret['data']            = $query;
  $ret['recordsTotal']    = intval($get_count['total_record']);
  $ret['recordsFiltered'] = intval($get_count['total_record']);
  $ret['draw']            = intval($draw);

} elseif ($act == "getData") {
  $tbl_select = "A.*";

  $tbl_join = "pembelajaran A LEFT JOIN akademik B ON A.tahun_ajaran = B.id ";
  $tbl_join .= "LEFT JOIN jurusan F ON A.id_jurusan = F.id ";
  $tbl_join .= "LEFT JOIN data_guru E ON F.id_guru = E.id ";

  $query = $cls->getArray($tbl_select, $tbl_join, "A.id=$id");

  $ret['result'] = $query;

} elseif ($act == "save") {

    if ($id == 0) {
        $data_array = array(
            "judul"        => $judul,
            "tahun_ajaran" => $tahun_ajaran,
            // "kurikulum"    => $kurikulum,
            "text_materi"  => $text_materi,
            "kelas_bidang_studi"        => $kelas_bidang_studi,
            "file"            => $file_new_name,
            "file_extension"  => $file_ext,
            "format_value"  => $format_value,
            "id_format"     => $id_format,
            "id_jurusan"    => $id_jurusan
        );

        if (empty($file_name)) {
            unset($data_array['file']);
            unset($data_array['file_extension']);

            $query = $cls->addNew("pembelajaran", $data_array);
            if ($query) {
                $ret['status'] = true;
            } else {
                $ret['status'] = false;
            }
        } else {
          if ($file_size > $max_uploads) {
            $ret['status']     = false;
            $ret['error_code'] = "over_size";
          } else {
            if (!in_array($file_ext, $valid_ext)) {
              $ret['status']     = false;
              $ret['error_code'] = "invalid_extension";
            } else {

              if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
                //Upload to document dir
                $upload_local = move_uploaded_file($file_tmp, $file_path.$file_new_name);

                if($upload_local){
                  $uploads        = gdrive_file("upload", $file_new_name);

                  if($uploads['status'] == true){
                    $data_array['file_id'] = $uploads['file_id'];
                    $query = $cls->addNew("pembelajaran", $data_array);

                    if ($query) {
                      $ret['status'] = true;
                    } else {
                      $ret['status'] = false;
                      $ret['error']  = $db->errorInfo();
                    }
                  }elseif($uploads['status'] == false){
                    $ret['status'] = "not_login";
                    $ret['callback_uri'] = $callbackUri;
                  }
                }else{
                  $ret['status']  = false;
                  $ret['error']   = "error_upload";
                }
              }else{
                $ret['status']        = "not_login";
                $ret['callback_uri']  = $callbackUri;
              }

            }
          }
        }

    } else {
        $data_array = array(
            "judul"        => $judul,
            "tahun_ajaran" => $tahun_ajaran,
            "text_materi"  => $text_materi,
            "kelas_bidang_studi"        => $kelas_bidang_studi,
            "file"         => $file_new_name,
            "file_extension"  => $file_ext,
            "format_value"  => $format_value,
            "id_format"     => $id_format,
            "id_jurusan"   => $id_jurusan
        );

        if (empty($file_name)) {
            unset($data_array['file']);
            unset($data_array['file_extension']);

            $query = $cls->update("pembelajaran", $data_array, "id=$id");

            if ($query) {
              $ret['status']   = true;
            } else {
                $ret['status'] = false;
                $ret['error']  = $db->errorInfo();
            }
        } else {
          if ($file_size > $max_uploads) {
            $ret['status']     = false;
            $ret['error_code'] = "over_size";
          } else {
            if (!in_array($file_ext, $valid_ext)) {
              $ret['status']     = false;
              $ret['error_code'] = "invalid_extension";
            } else {

              if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
                //Upload to document dir
                $upload_local = move_uploaded_file($file_tmp, $file_path.$file_new_name);

                if($upload_local){
                  $uploads        = gdrive_file("upload", $file_new_name);

                  if($uploads['status'] == true){
                    //Get Old File
                    $get_old_file_id        = $cls->getData("file_id","pembelajaran","id=".$id);
                    $data_array['file_id']  = $uploads['file_id'];

                    $query = $cls->update("pembelajaran", $data_array, "id=".$id);
                    if ($query) {
                      gdrive_file("delete", $get_old_file_id['file_id']);
                      $ret['status'] = true;
                    } else {
                      $ret['status'] = false;
                      $ret['error_code'] = $db->errorInfo();
                    }
                  }elseif($uploads['status'] == false){
                    $ret['status'] = "not_login";
                    $ret['callback_uri'] = $callbackUri;
                  }
                }else{
                  $ret['status']  = false;
                  $ret['error']   = "error_upload";
                }
              }else{
                $ret['status']        = "not_login";
                $ret['callback_uri']  = $callbackUri;
              }

            }
          }
        }

    }
} elseif ($act == "del") {
  $get_old_file_id = $cls->getData("file_id","pembelajaran","id=".$id);
  $old_file     = $get_old_file_id['file_id'];

  if($old_file !== null){
    if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {

      $delete_file = gdrive_file("delete", $get_old_file_id['file_id']);

      if($delete_file){

        $query = $cls->del("pembelajaran", "id=$id");

        if ($query) {
          $ret['status'] = true;
        } else {
          $ret['status']     = false;
          $ret['error_code'] = $db->errorInfo();
        }

      }else{
        $ret['status'] = false;
        $ret['error']  = $delete_file['error_code'];
      }

    } else {
      $ret['status'] = "not_login";
      $ret['callback_uri'] = $callbackUri;
    }
  }else{
    if ($query) {
      $ret['status'] = true;
    } else {
      $ret['status']     = false;
      $ret['error_code'] = $db->errorInfo();
    }
  }
} elseif ($act == "set_option") {

    $get_tahun_ajaran = $cls->getArray("id, tahun_ajaran", "akademik", "1=1");
    $get_kurikulum    = $cls->getArray("id, nama_kurikulum", "kurikulum", "1=1");
    $get_kelas        = $cls->getArray("id, nama_kelas", "kelas", "1=1");
    $get_format       = $cls->getArray("*", "format_pembelajaran", "1=1");
    $get_jurusan      = $cls->getArray("id, kode_jurusan, nama_jurusan", "jurusan", "1=1");

    $ret['tahun_ajaran'] = $get_tahun_ajaran;
    $ret['kurikulum']    = $get_kurikulum;
    $ret['kelas']        = $get_kelas;
    $ret['format_judul'] = $get_format;
    $ret['jurusan']      = $get_jurusan;

}else if($act == "changeState"){

    $lists = array(
      "is_ok"   => $is_ok,
    );
  
    $query    = $cls->update("pembelajaran", $lists, "id=".$id);
  
    if($query){
      $ret['status'] = true;
    }else{
      $ret['status'] = false;
    }
  
  }else if($act == "changeStatus"){
  
    $lists = array(
      "status"   => $status,
    );
  
    $query    = $cls->update("pembelajaran", $lists, "id=".$id);
  
    if($query){
      $ret['status'] = true;
    }else{
      $ret['status'] = false;
    }
  
  }

echo json_encode($ret);
