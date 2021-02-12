<?php
set_error_handler(function($errno, $errstr, $errfile, $errline, $errcontext) {
    if (0 === error_reporting()) {
        return false;
    }
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});

try {
    session_start();
    /*if (file_exists('engine/views/Install.php')) {
        require_once 'engine/views/Install.php';
        exit();
    }*/
    $token = $_SERVER['HTTP_HOST'];
    $token = password_hash($token, PASSWORD_BCRYPT, array('cost' => 9)); 
    require_once 'engine/Functions.php';
    require_once 'engine/Config.php';
    require_once 'engine/Database.php';
    require_once 'engine/Core.php';
    require_once 'engine/Data.php';
    $cms_plugins = array();
    $DB = new Database();
    $cms_core = new MiraCMS();
    $cms_core->run();
} catch (Exception $e) {
    $date = time();
    $full_date = date("y-m-d h:i:s",$date);
    $date = date("y-m-d",$date);
    $file = 'engine/logs/System_'.$date.'.txt';
    $fh = fopen($file, 'a+') or die("Fatal Error!");
    $logcontent = "Time : " . $full_date . "\r\n" . $e->getMessage() . "\r\n";
    fwrite($fh, $logcontent);
    fclose($fh);
    http_response_code(500);
}

exit();