<?php
ini_set("display_errors", 0);
session_name("siakad");
session_start();

//Require File
require_once("../config/init.php");
require_once "../model/Crud_basic.php";
require_once dirname(__DIR__, 1)."/drives/vendor/autoload.php";

$cls = new Crud_basic($db);

//Get File ID
$id              = isset($_POST['id']) ? $_POST['id'] : "";
$file_id         = isset($_POST['file_id']) ? $_POST['file_id'] : "";
$ret             = array();

$client = new Google_Client();
$client->setAuthConfig($secret_file);
$client->addScope(Google_Service_Drive::DRIVE);

if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {


  try{
    $client->setAccessToken($_SESSION['access_token']);

    $files = new Google_Service_Drive($client);
    $delete = $files->files->delete($file_id);

    if($delete){
      $file_data = array(
          "file_id"         => "",
          "file"            => "",
          "file_extension"  => ""
      );

      $update_file = $cls->update("pembelajaran",$file_data,"id=".$id);

      if($update_file){
        $ret['status']      = true;
      }else{
        $ret['status']      = false;
      }


    }else{
      $ret['status']      = false;
      $ret['error_code']  = "failed_upload";
    }
  }catch(Exception $e){
    $ret['status']      = "gdrive_false";
    $ret['error_code']  = $e->getMessage();
    $ret['callback_uri']  = $callbackUri;
  }

} else {
  $ret['status']        = "not_login";
  $ret['callback_uri']  = $callbackUri;
}

echo json_encode($ret);
