<?php

    function API_DeleteDataTable($arg){
        
        $tableName = htmlspecialchars("cms_".$arg);
        JSON::set('status','200');

        $db = new Mysql;
        $db->connect();
        $db->query("SHOW TABLES LIKE '".$tableName."'");

        if($db->existRows()){
            $query = $db->query("TRUNCATE ".$tableName);
            
            if($query){  
                JSON::set('message',"Success");
                die(JSON::get());
            }else{
                JSON::set('message','Database query error');
                die(JSON::get());
            }

        }else{
            die(JSON::get());
        }

        JSON::set('message','The table exists');
        die(JSON::get());

    }

?>