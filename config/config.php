<?php
    ob_start();
    session_start();
    date_default_timezone_set('Asia/Kathmandu');

    define('SITE_URL', 'http://newsportal.loc:8080');

    define("DB_HOST",'localhost');
    define("DB_USER",'root');
    define("DB_PWD",'');
    define("DB_NAME",'news_300');

    define('CLASS_PATH', $_SERVER['DOCUMENT_ROOT'].'/class');
    define('ERROR_LOG', $_SERVER['DOCUMENT_ROOT'].'/error/error.log');

    /*** Backend URL */
    define('CMS_URL', SITE_URL.'/cms');
    define('CMS_ASSETS_URL', CMS_URL.'/assets');
    define('CMS_JS_URL', CMS_ASSETS_URL.'/scripts');
    define('CMS_CSS_URL', CMS_ASSETS_URL.'/css');
    define('CMS_IMAGES_URL', CMS_ASSETS_URL.'/img');

    /*** Backend URL */

    define('CMS_SITE_TITLE', 'Newsportal, An online Nepali News website');

    define("ALLOWED_EXTENSIONS",array('jpg','jpeg','png','gif','bmp'));
    
    $allowed_exts = array('jpg','jpeg','png','gif','bmp');

    define('UPLOAD_DIR', $_SERVER['DOCUMENT_ROOT'].'/uploads/');
    define('UPLOAD_URL', SITE_URL.'/uploads/');

    $_states = array(
        "state1" => "State 1",
        "state2" => "State 2",
        "state3" => "Bagmati",
        "state4" => "Gandaki",
        "state5" => "State 5",
        "state6" => "Karnali",
        "state7" => "Sudur Paschim",
    );


    $ads_posn = array(
        'home1' => 'Banner Pop Up',
        'home6' => 'Home Above Logo',
        'home2' => 'Home Beside Logo',
        'home3' => 'Home 3',
        'home4' => 'Home 4',
        'home5' => 'Home 5',
        'home6' => 'Home 6',
        'detail1' => 'Detail 1',
        'detail2' => 'Detail 2',
        'detail3' => 'Detail 3',
        'detail4' => 'Detail 4',
        'detail5' => 'Detail 5',
    );




    define('SITE_KEYWORDS','nepal,nepali, visitnepal2020, online, news, newsportal, nepali news');
    define('SITE_DESCRIPTION','Newsportal is the first Nepali online newsportal website to provide all the Nepali news. ');


    define('ASSETS_URL',SITE_URL.'/asset');
    define('CSS_URL',ASSETS_URL.'/css');
    define('JS_URL',ASSETS_URL.'/js');
    define('IMAGES_URL',ASSETS_URL.'/img');