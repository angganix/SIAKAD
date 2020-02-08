<?php
session_start();
ini_set("display_errors", 1);

if (!isset($_POST['app_token']) && $_POST['app_token'] !== $_SESSION['app_token']) {
    die();
}

spl_autoload_register(function($class){
    $files = "../model/" . $class . ".php";
    if (file_exists($files)) {
        require_once $files;
    }
});