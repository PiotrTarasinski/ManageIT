<?php

class db{
    private $host="localhost";
    private $db_user="root";
    private $db_password="";
    private $db_name="manageit";
    private $mysqli;
    public function __construct(){
        $this->mysqli = new mysqli($this->host,$this->db_user,$this->db_password,$this->db_name);
        if($this->mysqli->connect_errno){
            echo "Nie udało się połączyć z serwerem bazy danych";
            exit();
        }
        if($this->mysqli->set_charset("utf8")){
            //zmieniono kodowanie   
        }
    }
    function __destruct(){
        $this->mysqli->close();
    }

    public function query($sql){
        $result = $this->mysqli->query($sql);
        return $result;
    }
}

?>