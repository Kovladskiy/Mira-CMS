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
        if(!preg_match ('/^([a-zA-Z0-9]+)$/', $data['admin_url'])){
            $error_text = 'Invalid characters';
        }
        if (empty($error_text)) {
              $success_text = "Mira CMS Was Installed!<br>Please, reload this page.";
              $config = file_get_contents('engine/Pre_Config.php');
              $config = str_replace('%DB_SERVER%', $data['db_server'], $config);
              $config = str_replace('%DB_USERNAME%', $data['db_username'], $config);
              $config = str_replace('%DB_PASSWORD%', $data['db_password'], $config);
              $config = str_replace('%DB_NAME%', $data['db_name'], $config);
              if (empty($data['admin_url'])) {
                  $data['admin_url'] == '/admin';
               }
              $config = str_replace('/%ADMIN_URL%', '/'.$data['admin_url'], $config);
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
              $options = [
                'cost' => 12,
              ];
              $data['admin_password'] = password_hash($data['admin_password'], PASSWORD_BCRYPT, $options);
              $query = $db->prepare('INSERT INTO miracms_admin_users (username, password) VALUES (?,?)');
              $query->execute(array($data['admin_username'],$data['admin_password']));
              file_put_contents('engine/Config.php', $config);
              unlink('engine/views/Install.php');
        }
    }
?>
<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="./favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
    <title>Mira CMS - Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <script src="/templates/Admin/Default/assets/js/require.min.js"></script>
    <script>
      requirejs.config({
          baseUrl: '/'
      });
    </script>
    <!-- Dashboard Core -->
    <link href="/templates/Admin/Default/assets/css/dashboard.css" rel="stylesheet" />
    <script src="/templates/Admin/Default/assets/js/dashboard.js"></script>
    <!-- c3.js Charts Plugin -->
    <link href="/templates/Admin/Default/assets/plugins/charts-c3/plugin.css" rel="stylesheet" />
    <script src="/templates/Admin/Default/assets/plugins/charts-c3/plugin.js"></script>
    <!-- Google Maps Plugin -->
    <link href="/templates/Admin/Default/assets/plugins/maps-google/plugin.css" rel="stylesheet" />
    <script src="/templates/Admin/Default/assets/plugins/maps-google/plugin.js"></script>
    <!-- Input Mask Plugin -->
    <script src="/templates/Admin/Default/assets/plugins/input-mask/plugin.js"></script>
  </head>
  <body class="">
    <div class="page">
      <div class="page-single">
        <div class="container">
          <div class="row">
            <div class="col col-login mx-auto">
              <div class="text-center mb-6"> 
                  Mira CMS
              </div>
              <form class="card" action="" method="post">
                <div class="card-body p-6">
                  <div class="card-title">Installation</div>      
                  <?php
                    if (!empty($error_text)) {
                        echo '<h4 style="color: red;">'.$error_text.'</h4>';
                    } else if (!empty($success_text)) {
                      echo '<h4 style="color: green;">'.$success_text.'</h4>';
                  }
                  ?>
                  <div class="form-group">
                    <label class="form-label">Database Server</label>
                    <input name="db_server" type="text" class="form-control" placeholder="Database Server">
                  </div>
                  <div class="form-group">
                    <label class="form-label">Database Username</label>
                    <input name="db_username" type="text" class="form-control" placeholder="Database Username">
                  </div>
                  <div class="form-group">
                    <label class="form-label">Database Password</label>
                    <input name="db_password" type="password" class="form-control"  placeholder="Database Password">
                  </div>
                  <div class="form-group">
                    <label class="form-label">Database name</label>
                    <input name="db_name" type="text" class="form-control" placeholder="Database name">
                  </div>
                  <div class="form-group">
                    <label class="form-label">Admin URL</label>
                    <input name="admin_url" type="text" class="form-control" placeholder="Admin URL">
                  </div>
                  <div class="form-group">
                    <label class="form-label">Admin Username</label>
                    <input name="admin_username" type="text" class="form-control"  placeholder="Admin Username">
                  </div>
                  <div class="form-group">
                    <label class="form-label">Admin Password</label>
                    <input name="admin_password" type="password" class="form-control" placeholder="Admin Password">
                  </div>
                  <div class="form-footer">
                    <button name="submit" type="submit" class="btn btn-primary btn-block">Install</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>