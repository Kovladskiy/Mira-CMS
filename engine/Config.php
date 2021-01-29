<?php
$db_server = 'localhost';
$db_username = 'root';
$db_password = 'root';
$db_name = 'cms';

$matching = [
    'n' => "/[^0-9]/",
    'w_1' => "/[^a-z]/",
    'w_2' => "/[^a-z]/",
    'w_3' => "/[^a-zA-Z0-9]/",
    'w_4' => "/[^a-zA-Z0-9]/"
];

$routes = [
    '/' => 'Home.php',
    '/api/{_w_1_}' => 'Api.php'
];