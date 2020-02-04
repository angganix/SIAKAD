<?php
spl_autoload_register(function($class){
    $core           = "app/core/" . $class . ".php";
    $controllers    = "app/controllers/" . $class . ".php";
    $models         = "app/models/". $class . ".php";

    if (file_exists($core)) {
        require_once $core;
    } elseif (file_exists($controllers)) {
        require_once $controllers;
    } elseif (file_exists($models)) {
        require_once $models;
    } else {
        return "Class Not Found";
    }
});