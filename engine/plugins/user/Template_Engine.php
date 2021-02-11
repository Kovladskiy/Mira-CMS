<?php
$plugin_name = 'Template_Engine';
$plugin_status = 'Enabled';
class Template_Engine extends MiraCMS {
    public function view($path, $mode) {
        global $current_template,$current_admin_template;
        $cms_data['news'] = array(array('title' => 'Test'),array('title' => 'Test'));
        $data_template = array();
        if ($mode == 'Admin') {
          $template = file_get_contents('templates/Admin/'.$current_admin_template.'/'.$path.'.html');
        }   else {
            $template = file_get_contents('templates/'.$current_template.'/'.$path.'.html');
        }
        preg_match_all('|{MiraCMS: {foreach_start (.+)}}|isU', $template, $matches1);
        foreach ($matches1[0] as $key => $match) {
            $explode = explode('{MiraCMS: {foreach_start ', $match);
            $explode = $explode[1];
            $explode = str_replace('}}','',$explode);
            $template = str_replace('{MiraCMS: {foreach_start '.$explode.'}}','<?php foreach ($cms_data["'.$explode.'"] as $value) { ?>', $template);
        }
        preg_match_all('|{MiraCMS: {foreach_end (.+)}}|isU', $template, $matches1);
        foreach ($matches1[0] as $key => $match) {
            $explode = explode('{MiraCMS: {foreach_end ', $match);
            $explode = $explode[1];
            $explode = str_replace('}}','',$explode);
            $template = str_replace('{MiraCMS: {foreach_end '.$explode.'}}','<?php } ?>', $template);
        }
        preg_match_all('|{MiraCMS: {echo_value (.+)}}|isU', $template, $matches1);
        foreach ($matches1[0] as $key => $match) {
            $explode = explode('{echo_value ', $match);
            $explode = $explode[1];
            $explode = str_replace('}}','',$explode);
            $template = str_replace('{MiraCMS: {echo_value '.$explode.'}}','<?php echo $value["'.$explode.'"]; ?>', $template);
        }
        eval(' ?>'.$template.'<?php ');
}
}
