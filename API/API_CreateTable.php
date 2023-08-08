<?php

    function API_CreateTable(){
        
        $data = Body::get();

        if(!$data){
            JSON::set('status','400');
            JSON::set('message','Invalid JSON data in the request body.');
            die(JSON::get());
        }

        $tableName = htmlspecialchars("cms_".$data["table"]);

        JSON::set('status','200');

        $db = new Mysql;
        $db->connect();
        $db->query("SHOW TABLES LIKE '".$tableName."'");
        
        if(!$db->existRows()){
            
            $query = $db->query("INSERT INTO `sys_enviroments` (`w_id`, `sys_name`, `sys_status`, `sys_create`) VALUES (NULL, '".$tableName."', '1',CURRENT_TIMESTAMP)");
            $query = $db->query("CREATE TABLE `m21375_restcms`.`".$tableName."` ( `w_id` INT NOT NULL AUTO_INCREMENT , `sys_status` INT NOT NULL , `sys_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `sys_author` VARCHAR(100) NOT NULL , PRIMARY KEY (`w_id`))");
            
            if($query){                
                JSON::set('message','Success');
                die(JSON::get());
            }else{
                JSON::set('message','Database query error');
                die(JSON::get());
            }

        }

        JSON::set('message','The table exists');
        die(JSON::get());

    }

?>