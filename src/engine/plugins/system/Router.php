<?php
$plugin_name = 'Router';
class Router extends MiraCMS {
    public function __construct() {
        global $routes,$matching;
        $url = $_SERVER['REQUEST_URI'];
        $request_explode = explode('/',$url);
        $access = 0;
        foreach ($routes as $key => $value) {
            $explode = explode('/',$key);
            if (preg_match_all('|{_(.+)_}|isU', $key, $arr)) {
                foreach ($arr[0] as $key1 => $arrs) {
                    $key1 = $key1 + 1;
                    $key = str_replace($arrs, $request_explode[$key1],$key);
                }
                array_shift($request_explode);
                foreach ($arr[1] as $key1 => $arrs) {
                    if (!preg_replace($matching[$arrs], '',$request_explode[$key1])) {
                        require_once __DIR__ . '/../../views/404.php';
                        exit();
                    }
                }
            } 
            if ($key == $url) {
                require_once __DIR__ . '/../../views/'.$value.'';
                $access = 1;
            break;
            }

        }
        if ($access != 1) {
            require_once __DIR__ . '/../../views/404.php';
        }

    }
}
