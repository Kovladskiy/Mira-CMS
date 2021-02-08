<?php
session_start();
require_once 'engine/Config.php';
require_once 'engine/Database.php';
require_once 'engine/Core.php';

set_error_handler(function($errno, $errstr, $errfile, $errline, $errcontext) {
    if (0 === error_reporting()) {
        return false;
    }
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});

try {
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