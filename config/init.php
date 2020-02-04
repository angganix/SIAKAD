<?php
session_name("siakad");
session_start();
require dirname(__DIR__, 1) ."/drives/vendor/autoload.php";
$secret_file     = dirname(__DIR__, 1)."/drives/client_secret.json";
$folderId        = "1qMJevrCDr0dhTn0UmUr-z87JGdXfNcVF";
$callbackUri     = "https://siakad.slbnegeri5jakarta.sch.id/callback.php";
$redirectUri     = 'https://' . $_SERVER['HTTP_HOST'] . '/drives/index.php';
$max_uploads     = 5242880;

//Gdrive Function
function gdrive_file($actions, $file_name){
  $ret            = array();
  $callback_uri   = "https://siakad.slbnegeri5jakarta.sch.id/callback.php";
  $filedir        = "../document/";
  $client         = new Google_Client();
  $folder_id      = "1qMJevrCDr0dhTn0UmUr-z87JGdXfNcVF";
  $files          = new Google_Service_Drive($client);
  $client->setAuthConfig($secret_file);
  $client->addScope(Google_Service_Drive::DRIVE);
  $client->setAccessToken($_SESSION['access_token']);

  if($actions == "upload"){

    try{
      $fileMetaData = new Google_Service_Drive_DriveFile(array(
        'name'  => $file_name,
        'parents' => array($folder_id),
      ));

      $content = file_get_contents($filedir.$file_name);
      $file = $files->files->create($fileMetaData, array(
        'data'        => $content,
        'uploadType'  => 'resumable',
        'fields'      => 'id'
      ));

      if($file){
        $ret['file_id'] = $file->id;
        $ret['status']  = true;
        unlink($filedir.$file_name);
      }else{
        $ret['status'] = false;
      }
    }catch(Exception $e){
      $ret['status'] = false;
      $ret['error_code'] = $e->getMessage();
    }

  }elseif($actions == "delete"){

    try{
      $delete = $files->files->delete($file_name);
      if($delete){
        $ret['status'] = true;
      }else{
        $ret['status'] = false;
      }
    }catch(Exception $e){
      $ret['status']     = false;
      $ret['error_code'] = $e->getMessage();
    }

  }

  return $ret;
}


ini_set("display_errors", "1");
require_once "db_conf.php";

date_default_timezone_set("Asia/Jakarta");

function month_to_bulan($str){
    $arr_bulan = array(
        "01" => "Januari",
        "02" => "Februari",
        "03" => "Maret",
        "04" => "April",
        "05" => "Mei",
        "06" => "Juni",
        "07" => "Juli",
        "08" => "Agustus",
        "09" => "September",
        "10" => "Oktober",
        "11" => "November",
        "12" => "Desember",
    );

    return $arr_bulan[$str];
}

function cleanInput($input)
{
    $str = htmlspecialchars(urldecode($input));
    $str = str_replace("'", "\'", $str);

    return $str;
}

function rupiah($str)
{
    return number_format($str, 0, ",", ".");
}

function formatingDates($str, $format_date)
{
    $tgl = date_create($str);
    if($str !== ""){
        return date_format($tgl, $format_date);
    }else{
        return "";
    }

}

function checkParentMenu($search, $state)
{
    $menu_array = array(
        "master"    => array(
            "data_identitas_sekolah",
            "data_kurikulum",
            "data_tahun_akademik",
            "data_golongan",
            "data_ketunaan",
            "data_jurusan",
            "data_jenis_ptk",
            "data_kelas",
            "data_status_kepegawaian",
            "data_agama"
        ),
        "pengguna" => array(
            "data_siswa",
            "data_orang_tua_wali",
            "data_guru",
            "data_administrator",
            "data_role_access"
        ),
        "ruang_guru" => array(
            "format_materi",
            "data_materi",
            "data_materi_keterampilan",
            "rekap_absensi_siswa",
            "data_files"
        )
    );

    if (in_array($search, $menu_array[$state])) {
        return "active";
    } else {
        return "";
    }
}

function checkMenu($cek, $cur)
{
    if ($cek == $cur) {
        return "class='active'";
    } else {
        return "";
    }
}

$db = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASS);

if (!$db) {
    die("Database connection error<br />" . print_r($db->errorInfo()));
}

//Function yang memiliki kebutuhan database
function getEnum($db, $tbl, $clm)
{
    $sql  = "SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='$tbl' AND COLUMN_NAME='$clm' ";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchColumn();
    $result = str_replace("enum", "", $result);
    $result = str_replace("(", "", $result);
    $result = str_replace(")", "", $result);
    $result = str_replace("'", "", $result);
    $result = explode(",", $result);

    return $result;
}
