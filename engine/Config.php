<?php
$db_server = 'localhost';
$db_username = 'root';
$db_password = 'root';
$db_name = 'cms';
$db_prefix = '';
$admin_url = '/admin';

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
    '/ajax/'.$token => 'Ajax.php',
    '/api/'.$token.'/{_w_1_}' => 'Api.php'
];