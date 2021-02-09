<?php
$db_server = '%DB_SERVER%';
$db_username = '%DB_USERNAME%';
$db_password = '%DB_PASSWORD%';
$db_name = '%DB_NAME%';
$admin_url = '/%ADMIN_URL%';

$matching = [
    'n' => "/[^0-9]/",
    'w_1' => "/[^a-z]/",
    'w_2' => "/[^a-z]/",
    'w_3' => "/[^a-zA-Z0-9]/",
    'w_4' => "/[^a-zA-Z0-9]/"
];

$routes = [
    '/' => 'Home.php',
    $admin_url => 'Admin/Home.php',
    ''.$admin_url.'/login' => 'Admin/Login.php',
    '/api/{_w_1_}' => 'Api.php'
];