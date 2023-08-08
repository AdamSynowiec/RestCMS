<?php

    function setup() {

        $databases = [

            "sys_enviroments" => "CREATE TABLE `sys_enviroments` ( `w_id` INT NOT NULL AUTO_INCREMENT , `sys_name` VARCHAR(100) NOT NULL , `sys_label` VARCHAR(100) NOT NULL ,`sys_status` INT NOT NULL , `sys_create` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL , PRIMARY KEY (`w_id`))",
            "sys_auth" => "CREATE TABLE `sys_auth` ( `w_id` INT NOT NULL AUTO_INCREMENT , `sys_secretKey` TEXT NOT NULL , `sys_lifeTime` varchar(100) NOT NULL , PRIMARY KEY (`w_id`))"

        ];

        $db = new Mysql();
        $db->connect();

        foreach ($databases as $table => $query) {
            $db->query("SHOW TABLES LIKE '".$table."'");

            if(!$db->existRows()){
                
                $query = $db->query($query);
                if($query){
                    JSON::set($table,'Has been installed successfully');
                }
            }
        }

        die(JSON::get());
    }

?>