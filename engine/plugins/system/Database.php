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
            $date = time();
            $date = date("Y-m-d",$date);
            $full_date = date("Y-m-d h:i:s",$date);
            $file =  '../engine/logs/Database_'.$date.'.txt';
            $fh = fopen($file, 'a+') or die("Fatal Error!");
            $logcontent = "Time : " . $full_date . "\r\n" . $e->getMessage() . "\r\n";
            fwrite($fh, $logcontent);
            fclose($fh);
            http_response_code(500);
            exit();
        }
    }
    public function create() {
        return $this->db;
    }
}
