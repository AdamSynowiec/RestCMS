<?php

    function API_GetDataTable($arg,$id){
        
        $tableName = htmlspecialchars("cms_".$arg);
        $id = htmlspecialchars($id);
        JSON::set('status','200');
        
        $db = new Mysql;
        $db->connect();
        $db->query("SHOW TABLES LIKE '".$tableName."'");

        if($db->existRows()){
            if($id){
                $query = $db->query("SELECT * FROM ".$tableName." WHERE w_id in(".$id.")");
            }else{
                $query = $db->query("SELECT * FROM ".$tableName);
            }
            
            if($query){  
                $data = $db->fetchAll();    
                JSON::set('message',"Success");
                JSON::set('data',$data);          
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