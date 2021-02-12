<?php
function check_admin_auth($username, $password) {
    global $DB;
    $result = $DB->query('cms_admin_users','SELECT','','username = ? AND password = ?',array($username, $password));
    if (empty($result)) {
        return false;
    } 
    return true;
}
/*function randomSalt($len = 8) {
    global $token;
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789`~!@#$%^&*()-=_+';
	$l = strlen($chars) - 1;
	$str = '';
	for ($i = 0; $i &lt; $len; ++$i) {
		$str .= $chars[rand(0, $l];
 	}
	return $str;
}*/
function salt($len = 12) {
        global $token;
        echo $token;
}