<?php
$post = $_POST;
if (!empty($post)) {
    $result = check_admin_auth($post['username'],$post['password']);
    if ($result) {
        echo 'Ok';
    }   else {
        echo 'Bad attempt';
    }
}
$cms_plugins['Template_Engine']->view('Login','Admin');
?>