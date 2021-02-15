<?php
error_reporting(0);

define('WORKING_DIRECTORY', getcwd());

function ShutdownFunction()  {
    chdir(WORKING_DIRECTORY);
    $err = error_get_last();
    $date = time();
    $full_date = date("y-m-d h:i:s",$date);
    $date = date("y-m-d",$date);
    $file = 'engine/logs/System_'.$date.'.txt';
    $logcontent = 'Error handler got occurred in '.$err["file"].' at line '.$err["line"].': '.$err["message"].' | Time: '.$full_date.'';
    file_put_contents($file, $logcontent.PHP_EOL , FILE_APPEND | LOCK_EX);
    error_log($logcontent, 3, $file);
    http_response_code(500);
    exit();
}

register_shutdown_function('ShutdownFunction');

session_start();

/*if (file_exists('engine/views/Install.php')) {
    require_once 'engine/views/Install.php';
    exit();
}*/

require_once 'engine/Functions.php';
require_once 'engine/Config.php';
require_once 'engine/Database.php';
require_once 'engine/Core.php';
require_once 'engine/Dasta.php';
    
$cms_plugins = array();
$DB = new Database();
$cms_core = new MiraCMS();
$cms_core->run();

exit();