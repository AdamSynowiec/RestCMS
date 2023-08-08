<?php

    class Mysql {

        private $host;
        private $user;
        private $password;
        private $dbName;
        private $connection;
        private $query;
    
        public function __construct(){
            $this->host = "mysql.ct8.pl";
            $this->user = "m21375_useradmin";
            $this->password = "QZHRnFHBmdBz0n9YrLvs";
            $this->dbName = "m21375_restcms";
        }
    
        public function connect() {
            $this->connection = mysqli_connect($this->host, $this->user, $this->password, $this->dbName);
            mysqli_set_charset($this->connection, "utf8");
    
            if (!$this->connection) {
                die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
            }
        }

        public function query($query){
            $this->query = mysqli_query($this->connection,$query);
            if($this->query){
                return true;
            }else{
                return false;
            }
        }

        public function existRows(){
            if(mysqli_num_rows($this->query) != 0){
                return true;
            }else{
                return false;
            }
        }

        public function fetchAll(){
            $data = array();
            while ($row = mysqli_fetch_object($this->query)) {
                $data[] = $row;
            }
            return json_encode($data);
        }

    }
/*
    $db = new Mysql;
    $db->connect();
    $db->query("select * from cms_users");
    $data = $db->fetchAll();
*/
?>