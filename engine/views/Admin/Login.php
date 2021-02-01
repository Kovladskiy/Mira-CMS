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
?>
<!DOCTYPE HTML">
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Вход в админ панель</title>
 </head>
 <body>
        
 </body>
</html>