<?php
require_once __DIR__.'/engine/Config.php';
require_once __DIR__.'/engine/Core.php';

$cms_plugins = array();
$cms_core = new MiraCMS();
$cms_core->run();
$cms_plugins['Template_Engine']->view('Test');

exit();