<?php
session_name("siakad");
session_start();
require_once "../config/init.php";
require_once "../model/Crud_basic.php";

//Create Object class
$cls = new Crud_basic($db);

//Group of Variable
$act      = isset($_POST['act']) ? $_POST['act'] : "";
$offset   = isset($_POST['start']) ? $_POST['start'] : 0;
$perPage  = isset($_POST['length']) ? $_POST['length'] : 10;
$draw     = isset($_POST['draw']) ? $_POST['draw'] : 1;
$sortBy   = isset($_POST['order'][0]['column']) ? $_POST['order'][0]['column'] : 0;
$sortDir  = isset($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 'desc';
$criteria = isset($_POST['search']['value']) ? $_POST['search']['value'] : "1=1";

$fieldSort    = array("judul_file","nama_file");
$fieldSearch  = array("judul_file","nama_file");
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
$id_files       = isset($_POST['id']) ? $_POST['id'] : "";
$judul_file     = isset($_POST['judul_file']) ? $_POST['judul_file'] : "";
$keterangan     = isset($_POST['keterangan']) ? $_POST['keterangan'] : "";
$is_active      = isset($_POST['is_active']) ? $_POST['is_active'] : 1;
$time_add       = date("Y-m-d H:i:s");

//Files Upload
$file_name      = $_FILES['file']['name'];
$file_tmp       = $_FILES['file']['tmp_name'];
$file_size      = isset($_FILES['file']['size']) ? $_FILES['file']['size'] : "";
$file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
$file_new_name  = str_replace(" ","_",$judul_file);
$file_new_name  = $file_new_name."-".date("YmdHis").".".$file_extension;
$valid_ext      = array("doc","docx","pptx","ppt","xls","xlsx");
$file_path      = "../document/";

if ($act == "getAll") {

    $query = $cls->getArray("*", "files", "($criteria) ORDER BY $fieldSort[$sortBy] $sortDir LIMIT $offset, $perPage");

    $get_count = $cls->getCount("*", "files","($criteria)");

    $ret['data']            = $query;
    $ret['recordsTotal']    = intval($get_count['total_record']);
    $ret['recordsFiltered'] = intval($get_count['total_record']);
    $ret['draw']            = intval($draw);

} elseif ($act == "getData") {

    $query = $cls->getArray("*", "files", "id_files=" . $id_files);

    $ret['result'] = $query;

} elseif ($act == "save") {

    if ($id_files == 0) {

      $data_array = array(
          "judul_file"      => $judul_file,
          "keterangan"      => $keterangan,
          "time_add"        => $time_add,
          "nama_file"       => $file_new_name,
          "file_extension"  => $file_extension
      );

      if ($file_size > $max_uploads) {
        $ret['status']     = false;
        $ret['error_code'] = "over_size";
      } else {
        if (!in_array($file_extension, $valid_ext)) {
          $ret['status']     = false;
          $ret['error_code'] = "invalid_extension";
        } else {

          if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            //Upload to document dir
            $upload_local = move_uploaded_file($file_tmp, $file_path.$file_new_name);

            if($upload_local){
              $upload_file = gdrive_file("upload", $file_new_name);

              if($upload_file['status'] == true){
                $data_array['file_id'] = $upload_file['file_id'];

                $query = $cls->addNew("files", $data_array);
                if ($query) {
                  $ret['status'] = true;
                } else {
                  $ret['status'] = false;
                }

              }else{
                $ret['status'] = "not_login";
                $ret['callback_uri'] = $callbackUri;
              }
            }else{
              $ret['status']  = false;
              $ret['error']   = "error_upload_local";
            }

          } else {
            $ret['status'] = "not_login";
            $ret['callback_uri'] = $callbackUri;
          }

        }
      }

    } else {

      $data_array = array(
          "judul_file"      => $judul_file,
          "keterangan"      => $keterangan,
          "time_add"        => $time_add,
          "nama_file"       => $file_new_name,
          "file_extension"  => $file_extension
      );

      if (empty($file_name)) {
          unset($data_array['nama_file']);
          unset($data_array['file_extension']);

          $query = $cls->update("files", $data_array, "id_files=$id_files");
          if ($query) {
              $ret['status'] = true;
          } else {
              $ret['status'] = false;
          }
      }else{
        if ($file_size > $max_uploads) {
          $ret['status']     = false;
          $ret['error_code'] = "over_size";
        } else {
          if (!in_array($file_extension, $valid_ext)) {
            $ret['status']     = false;
            $ret['error_code'] = "invalid_extension";
          } else {

            if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
              //Upload to document dir
              $upload_local = move_uploaded_file($file_tmp, $file_path.$file_new_name);

              if($upload_local){

                $upload_file = gdrive_file("upload", $file_new_name);

                if($upload_file['status'] == true){
                  $data_array['file_id'] = $upload_file['file_id'];
                  $get_old_file_id = $cls->getData("file_id","files","id_files=".$id_files);

                  $query = $cls->update("files", $data_array, "id_files=".$id_files);

                  if ($query) {
                    gdrive_file("delete", $get_old_file_id['file_id']);
                    $ret['status'] = true;
                  } else {
                    $ret['status'] = false;
                    $ret['error_code'] = $db->errorInfo();
                  }

                }else{
                  $ret['status'] = "not_login";
                  $ret['callback_uri'] = $callbackUri;
                }
              }else{
                $ret['status'] = false;
                $ret['error_code'] = "error_upload_local";
              }

            } else {
              $ret['status'] = "not_login";
              $ret['callback_uri'] = $callbackUri;
            }

          }
        }
      }

    }


} elseif ($act == "del") {
    $get_old_file_id = $cls->getData("file_id","files","id_files=".$id_files);
    $old_file     = $get_old_file_id['file_id'];

    if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {

      $delete_file = gdrive_file("delete", $old_file);

      if($delete_file){

        $query = $cls->del("files", "id_files=" . $id_files);

        if ($query) {
          $ret['status'] = true;
        } else {
          $ret['status']     = false;
          $ret['error_code'] = $db->errorInfo();
        }

      }else{
        $ret['status'] = false;
        $ret['error_code'] = $delete_file['error_code'];
      }

    } else {
      $ret['status'] = "not_login";
      $ret['callback_uri'] = $callbackUri;
    }

}elseif($act == "changeStatus"){

  $data_array = array(
    "is_active"  => $is_active
  );

  $query = $cls->update("files", $data_array, "id_files=".$id_files);

  if($query){
    $ret['status'] = true;
  }else{
    $ret['status'] = false;
    $ret['error_code'] = $db->errorInfo();
  }

}

echo json_encode($ret);
