<?php
function check_admin_auth($username, $password) {
    global $DB;
    $result = $DB->query('cms_admin_users','SELECT','','username = ? AND password = ?',array($username, $password));
    if (empty($result)) {
        return false;
    } 
    return true;
}