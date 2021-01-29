<?php
class MiraCMS {
    public function run () {    
        global $cms_plugins,$user_plugins;

        $plugins = scandir(__DIR__.'/plugins/user/');
        $plugins_files = array();
        
        foreach ($plugins as $plugin) {
            if ($plugin != '.') {
                if ($plugin != '..') {
                    array_push($plugins_files,$plugin);
                }
            }
        }
        
        foreach ($plugins_files as $plugin) {
            if (file_exists(__DIR__.'/plugins/user/'.$plugin)) {
                require_once __DIR__.'/plugins/user/'.$plugin;
                if ($plugin_status == 'Enabled') {
                if (!empty($plugin_name)) {
                    if (class_exists($plugin_name)) {
                        $load_class = new $plugin_name;
                        $cms_plugins[$plugin_name] = $load_class;
                    }
                }
                }
            }
        }


        $plugins = scandir(__DIR__.'/plugins/system/');
        $plugins_files = array();
        
        foreach ($plugins as $plugin) {
            if ($plugin != '.') {
                if ($plugin != '..') {
                    array_push($plugins_files,$plugin);
                }
            }
        }
        
        foreach ($plugins_files as $plugin) {
            if (file_exists(__DIR__.'/plugins/system/'.$plugin)) {
                require_once __DIR__.'/plugins/system/'.$plugin;
                if (!empty($plugin_name)) {
                    if (class_exists($plugin_name)) {
                        $load_class = new $plugin_name;
                        $cms_plugins[$plugin_name] = $load_class;
                    }
                }
            }
        }

    }
}