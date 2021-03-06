<?php
class Database {
    public $db, $data_encryption = 'no';
    public function __construct() {
        global $db_server, $db_name,$db_username,$db_password;
        $dbh = new PDO('mysql:host='.$db_server.';dbname='.$db_name.'', $db_username, $db_password);
        $this->db = $dbh;
    }
    public function query($table,$statement,$set_condition,$search_condition,$data) {
        $db = $this->db;
        $result = NULL;
        if ($statement == 'SELECT') {
            if (!empty($search_condition)) {
                $query = $db->prepare('SELECT * FROM '.$table.' WHERE '.$search_condition.'');
                $query->execute($data);
                $result = $query->fetch(PDO::FETCH_ASSOC);
            }   else {
                $query = $db->prepare('SELECT * FROM '.$table.'');
                $query->execute($data);
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
            }
         }  else if ($statement == 'UPDATE') {
            $query = $db->prepare('UPDATE '.$table.' SET '.$set_condition.' WHERE '.$search_condition.'');
            $query->execute($data);
         }  else if ($statement == 'DELETE') {
            $query = $db->prepare('DELETE FROM '.$table.' WHERE '.$search_condition.'');
            $query->execute($data);
         }  else if ($statement == 'INSERT') {
            $values = '';
            $explode = explode(',',$set_condition);
            $i = 0;
            foreach ($explode as $value) {
                if ($i == 0) {
                    $values .= '?';
                    $i = $i + 1;
                }   else {
                    $values .= ',?';
                }
            }

            $query = $db->prepare('INSERT INTO '.$table.' ('.$set_condition.') VALUES ('.$values.')');
            $query->execute($data);
        }
        return $result;
    }
}
