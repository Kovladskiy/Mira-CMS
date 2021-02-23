<?php
$db_server = 'localhost';
$db_username = 'root';
$db_password = 'root';
$db_name = 'cms';
$db_prefix = '';
$admin_url = '/admin';
$token = $_SERVER['HTTP_HOST'];
$secret_key = 'asasd';
$token = password_hash($secret_key.$token.$secret_key, PASSWORD_BCRYPT, array('cost' => 9)); 

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
    ''.$admin_url.'/ajax_content'.$token.'' => 'Admin/Ajax_Content.php',
    '/api/'.$token.'/{_w_1_}' => 'Api.php'
];