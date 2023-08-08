<?php

    function API_GetTable(){
       
        $db = new Mysql;
        $db->connect();
        $query = $db->query("SELECT * FROM sys_enviroments WHERE sys_status = 1");

        if($db->existRows()){
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