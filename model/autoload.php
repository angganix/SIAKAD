<?php
spl_autoload_register(function($class){
    $files = "../model/" . $class . ".php";
    if (file_exists($files)) {
        require_once $files;
    }
});