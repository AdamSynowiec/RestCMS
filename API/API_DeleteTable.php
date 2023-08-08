<?php

    function API_DeleteTable(){
        
        $data = Body::get();

        if(!$data){
            JSON::set('status','400');
            JSON::set('message','Invalid JSON data in the request body.');
            die(JSON::get());
        }

        $tableName = htmlspecialchars("cms_".$data["table"]);

        $db = new Mysql;
        $db->connect();
        $db->query("SHOW TABLES LIKE '".$tableName."'");
        
        if($db->existRows()){
            
            $query = $db->query("DROP TABLE `".$tableName."`");
            $query = $db->query("DELETE FROM `sys_enviroments` WHERE sys_name = '".$tableName."'");

            if($query){
                JSON::set('status','200');
                JSON::set('message','Success');
                die(JSON::get());
            }else{
                JSON::set('status','200');
                JSON::set('message','Database query error');
                die(JSON::get());
            }
        }else{
            JSON::set('status','404');
            JSON::set('message','Table '.$tableName.' does not exist');
            die(JSON::get());
        }

        JSON::set('status','200');
        JSON::set('message','The table does not exist');
        die(JSON::get());

    }

?>