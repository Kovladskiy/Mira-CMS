<?php
$plugin_name = 'Database';
class Database extends MiraCMS {
    public $db;
    public function __construct() {
        global $db_server, $db_name,$db_username,$db_password;
        try {
            $dbh = new PDO('mysql:host='.$db_server.';dbname='.$db_name.'', $db_username, $db_password);
            $this->db = $dbh;
        } catch (PDOException $e) {
            $key = time();
            $file =  __DIR__.'../../logs/Database_'.$key.'.miralogs';
            $content = "Error:   ".$e->getMessage()."\n";
            file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
            http_response_code(500);
        }
    }
    public function create() {
        $db = $this->db;
    }
}
