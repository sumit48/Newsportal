<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/config/config.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/config/functions.php';

    spl_autoload_register(function($class_name){
         CLASS_PATH."/".$class_name.".php";
    }); 