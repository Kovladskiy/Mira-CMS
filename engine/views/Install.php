<?php
    $data = $_POST;
    if (!empty($data)) {

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
      <fieldset>
        <input placeholder="Database Server" type="text" tabindex="1" required autofocus>
      </fieldset>
      <fieldset>
        <input placeholder="Database Username" type="text" tabindex="2" required>
      </fieldset>
      <fieldset>
        <input placeholder="Database Password" type="text" tabindex="3" required>
      </fieldset>
      <fieldset>
        <input placeholder="Database Name" type="text" tabindex="4" required>
      </fieldset>
      <fieldset>
        <input placeholder="Admin URL" type="text" tabindex="4" required>
      </fieldset>
      <fieldset>
        <input placeholder="Admin Username" type="text" tabindex="4" required>
      </fieldset>
      <fieldset>
        <input placeholder="Admin Password" type="text" tabindex="4" required>
      </fieldset>
      <fieldset>
        <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Install</button>
      </fieldset>
      <p class="copyright">Designed by <a href="https://colorlib.com" target="_blank" title="Colorlib">Colorlib</a></p>
    </form>
  </div>
</body>
</html>
