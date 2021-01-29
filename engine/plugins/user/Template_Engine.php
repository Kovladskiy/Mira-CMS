<?php
$plugin_name = 'Template_Engine';
$plugin_status = 'Enabled';
class Template_Engine extends MiraCMS {
    public function view($path) {
        $cms_data['news'] = array(array('title' => 'Test'),array('title' => 'Test'));
        $template = file_get_contents('templates/'.$path.'.miracms');
        $data_template = array();

        preg_match_all('|{MiraCMS- (.+)}|isU', $template, $matches);
        foreach ($matches[0] as $key => $match) {
            $explode = explode(' ', $match);
            $explode[1] = str_replace('}','',$explode[1]);
    
            $template = substr($template, strpos($template, '{MiraCMS-'));
            $template = str_replace('{MiraCMS- '.$explode[1].'}','<?php foreach ($cms_data["'.$explode[1].'"] as $value) { ?>', $template);
        }

        preg_match_all('|{MiraCMS.- (.+)}|isU', $template, $matches2);
        foreach ($matches2[0] as $key => $match) {
            $explode = explode(' ',$match);
            if ($explode[0] == '{MiraCMS.-') {
                $explode[1] = str_replace('}','',$explode[1]);
                $explode = explode('.',$explode[1]);
                $template = str_replace('{MiraCMS.- '.$explode[0].'.'.$explode[1].'}','<?php echo $value["'.$explode[1].'"]; ?>', $template);
            }
        }

        preg_match_all('|{MiraCMS/- (.+)}|isU', $template, $matches1);
        foreach ($matches1[0] as $key => $match) {
            $explode = explode(' ', $match);
            $explode[1] = str_replace('}','',$explode[1]);
            $template = substr($template, strpos($template, '{MiraCMS-'));
            $template = str_replace('{MiraCMS/- '.$explode[1].'}','<?php } ?>', $template);
        }

        eval(' ?>'.$template.'<?php ');


}
}
