<?php
   
    class Config {

        public static function apiKey() { 
            $db = new Mysql;
            $db->connect();
            
            $db->query("SHOW TABLES LIKE 'sys_auth'");
            
            if($db->existRows()){
                $db->query("SELECT * FROM `sys_auth`");
                    if($db->existRows()){
                    $secretKey = json_decode($db->fetchAll());
                    return $secretKey[0]->sys_secretKey;
                }
            }else{
                return "admin_setup";
            }
        }
        public static function lng()    { return "PL"; }
        public static function CORS_POLICY()    { return "https://client.restcms.ct8.pl/"; }

    }

?>