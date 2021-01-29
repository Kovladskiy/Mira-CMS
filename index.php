<?php
require_once __DIR__.'/engine/Config.php';
require_once __DIR__.'/engine/Core.php';

try {
    $cms_plugins = array();
    $cms_core = new MiraCMS();
    $cms_core->run();
} catch (Exception $e) {
    $date = time();
    $date = date("Y-m-d",$date);
    $full_date = date("Y-m-d h:i:s",$date);
    $file =  'engine/logs/System_'.$date.'.txt';
    $fh = fopen($file, 'a+') or die("Fatal Error!");
    $logcontent = "Time : " . $full_date . "\r\n" . $e->getMessage() . "\r\n";
    fwrite($fh, $logcontent);
    fclose($fh);
    http_response_code(500);
}

exit();
