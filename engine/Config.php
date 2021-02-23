<?php
$is_installed = 'no';

$matching = [
    '{{only_numbers}}' => '0-9',
    '{{only_numbers_and_letters}}' => '0-9a-z',
]; 

$routes = [
    '/' => 'Home',
    '/test/{{only_numbers}}/{{only_numbers_and_letters}}' => 'Home'
];