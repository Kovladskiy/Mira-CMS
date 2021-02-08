<?php
    $data = $_POST;
    if (!empty($data)) {
        try {
        $db_server = $data['db_server'];
        $db_name = $data['db_name'];
        $db_username = $data['db_username'];
        $db_password = $data['db_password'];
        $dbh = new PDO('mysql:host='.$db_server.';dbname='.$db_name.'', $db_username, $db_password);
        } catch (Exception $e) {
            $error_text = 'Error connecting to Database!';
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
      <h3>Mira CMS</h3>
      <h4>Write correct data to install Mira CMS</h4>
      <?php
        if (!empty($error_text)) {
            echo '<h4 style="color: red;">'.$error_text.'</h4>';
        }
      ?>
      <fieldset>
        <input placeholder="Database Server" name="db_server" type="text" tabindex="1" required autofocus>
      </fieldset>
      <fieldset>
        <input placeholder="Database Username" name="db_username" type="text" tabindex="2" required>
      </fieldset>
      <fieldset>
        <input placeholder="Database Password" name="db_password" type="text" tabindex="3" required>
      </fieldset>
      <fieldset>
        <input placeholder="Database Name" name="db_name" type="text" tabindex="4" required>
      </fieldset>
      <fieldset>
        <input placeholder="Admin URL" name="admin_url" type="text" tabindex="4" required>
      </fieldset>
      <fieldset>
        <input placeholder="Admin Username" name="admin_username" type="text" tabindex="4" required>
      </fieldset>
      <fieldset>
        <input placeholder="Admin Password" name="admin_password" type="text" tabindex="4" required>
      </fieldset>
      <fieldset>
        <button name="submit" type="submit">Install</button>
      </fieldset>
      <p class="copyright">Designed by <a href="https://colorlib.com" target="_blank" title="Colorlib">Colorlib</a></p>
    </form>
  </div>
</body>
</html>
