<?php
error_reporting(0);

define('WORKING_DIRECTORY', getcwd());
define('MIRACMS_MINIMUM_PHP', '8.0.1');

function ShutdownFunction()  {
    chdir(WORKING_DIRECTORY);
    $err = error_get_last();
    if (!empty($err)) {
        $date = time();
        $full_date = date("y-m-d h:i:s",$date);
        $date = date("y-m-d",$date);
        $file = 'engine/logs/System_Error_'.$date.'.txt';
        $logcontent = 'Error handler got occurred in '.$err["file"].' at line '.$err["line"].': '.$err["message"].' | Time: '.$full_date.'';
        file_put_contents($file, $logcontent.PHP_EOL , FILE_APPEND);
        http_response_code(500);
        exit();
    }
}

register_shutdown_function('ShutdownFunction');

require_once __DIR__.'/Autoloader.php';

if (version_compare(PHP_VERSION, MIRACMS_MINIMUM_PHP, '<'))  {
    die('Your host needs to use PHP ' . MIRACMS_MINIMUM_PHP . ' or higher to run this version of MiraCMS!');
}

$url = $_SERVER['REQUEST_URI'];
$request_explode = explode('/',$url);
$access = 0;
$is_normal = 'no';
$router = '/';
$cms_modules = [];

if ($is_installed == 'no') {
    if (file_exists(__DIR__.'/views/Installer.php')) {
        require_once __DIR__.'/views/Installer.php';
        exit();
    }
}

$explode = '';

foreach ($routes as $key => $value) {
    $explode = explode('/', $key);
    if (!empty($explode[1])) {
        foreach ($explode as $key1 => $value1) {
            foreach ($matching as $key2 => $value2) {
                if ($value1 == $key2) {
                    if (!empty($request_explode[$key1])) {
                        $explode = str_replace($value1, $request_explode[$key1],$explode);
                    }
                }

            }
        }
        $router = '';
        foreach ($explode as $value3) {
            if (!empty($value3)) {
                $router .= '/'.$value3;
            }
        }
    }
    if ($url == $router) {
        if (file_exists(__DIR__.'/views/'.$value.'.php')) {
            require_once __DIR__.'/views/'.$value.'.php';
            $access = 1;
        }   else {
            http_response_code(500);
            exit();
        }
    break;
    }
}

if ($access != 1) {
    if (file_exists(__DIR__.'/views/404.php')) {
        require_once __DIR__.'/views/404.php';
    }   else {
        http_response_code(404);
        exit();
    }
}

$modules = scandir(__DIR__.'/modules/');        
$modules_files = array();
        
foreach ($modules as $module) {
    if ($module != '.') {
        if ($module != '..') {
            array_push($modules_files,$module);
        }
    }
}

foreach ($modules_files as $module) {
    if (file_exists(__DIR__.'/modules/'.$module)) {
        require_once __DIR__.'/modules/'.$module;
        if ($module_status == 'Enabled') {
        if (!empty($module_name)) {
            if (class_exists($module_name)) {
                $load_class = new $module_name;
                $cms_modules[$module_name] = $load_class;
                $cms_modules[$module_name]->activation();
            }
        }
        }
    }
}

exit();
