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
            http_response_code(500);
            //print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    public function create() {
        $db = $this->db;
    }
}