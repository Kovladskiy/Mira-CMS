<?php
    $data = $_POST;
    if (!empty($data)) {
        try {
        $db_server = $data['db_server'];
        $db_name = $data['db_name'];
        $db_username = $data['db_username'];
        $db_password = $data['db_password'];
        $db = new PDO('mysql:host='.$db_server.';dbname='.$db_name.'', $db_username, $db_password);
        } catch (PDOException $e) {
            $error_text = 'Error connecting to Database!';
        }
        if(!preg_match ('/^([a-zA-Z]+)$/', $data['admin_url'])){
            $error_text = 'Invalid characters';
        }
        if (empty($error_text)) {
              $success_text = 'Mira CMS Was Installed! Please, click on "Continue" button.';
              $config = file_get_contents('engine/Config.php');
              $config = str_replace('%DB_SERVER%', $data['db_server'], $config);
              $config = str_replace('%DB_USERNAME%', $data['db_username'], $config);
              $config = str_replace('%DB_PASSWORD%', $data['db_password'], $config);
              $config = str_replace('%DB_NAME%', $data['db_name'], $config);
              if (empty($data['admin_url'])) {
                  $data['admin_url'] == 'admin';
               }
              $config = str_replace('/%ADMIN_URL%', $data['admin_url'], $config);
              $query = "CREATE TABLE miracms_config_data (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                data_key VARCHAR(256) NOT NULL,
                data_value VARCHAR(256) NOT NULL
                )";
              $db->exec($query);
              $query = "CREATE TABLE miracms_admin_users (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(256) NOT NULL,
                password VARCHAR(256) NOT NULL
                )";
              $db->exec($query);
              $query = $db->prepare('INSERT INTO miracms_config_data (data_key, data_value) VALUES (?,?)');
              $query->execute(array('current_template','Default'));
              $query = $db->prepare('INSERT INTO miracms_admin_users (username, password) VALUES (?,?)');
              $query->execute(array($data['admin_username'],$data['admin_password']));
              file_put_contents('engine/Config.php', $config);
              unlink('engine/views/Install.php');
        }
    }
?>
<!DOCTYPE HTML>
<html lang="ru">
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Installation Mira CMS</title>
	<link rel="stylesheet" href="/templates/Install/style.css" />
</head>
<body>
  <div class="container">  
    <form id="contact" action="" method="post">
      <h3>Mira CMS Installer</h3><hr><br>
      <?php
        if (!empty($error_text)) {
            echo '<h4 style="color: red;">'.$error_text.'</h4>';
        } else if (!empty($success_text)) {
          echo '<h4 style="color: green;">'.$success_text.'</h4>';
      }
      ?>
      <fieldset>
        <input placeholder="Database Server" name="db_server" type="text" tabindex="1" required autofocus>
      </fieldset>
      <fieldset>
        <input placeholder="Database Username" name="db_username" type="text" tabindex="2" required>
      </fieldset>
      <fieldset>
        <input placeholder="Database Password" name="db_password" type="password" tabindex="3" required>
      </fieldset>
      <fieldset>
        <input placeholder="Database Name" name="db_name" type="text" tabindex="4" required>
      </fieldset>
      <fieldset>
        <input placeholder="Admin URL" name="admin_url" type="text" tabindex="5" required>
      </fieldset>
      <fieldset>
        <input placeholder="Admin Username" name="admin_username" type="text" tabindex="6" required>
      </fieldset>
      <fieldset>
        <input placeholder="Admin Password" name="admin_password" type="password" tabindex="7" required>
      </fieldset><br>
      <fieldset>
        <button name="submit" type="submit">Install</button>
      </fieldset>
      <p class="copyright">Designed by <a href="https://colorlib.com" target="_blank" title="Colorlib">Colorlib</a></p>
    </form>
  </div>
</body>
</html>
