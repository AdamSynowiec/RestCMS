<?php

function API_CreateAttribute()
{

    $data = Body::get();

    if(!$data){
        JSON::set('status','400');
        JSON::set('message','Invalid JSON data in the request body.');
        die(JSON::get());
    }

    $tableName = htmlspecialchars("cms_".$data["table"]);

    JSON::set("status", "200");
    
    $db = new Mysql();
    $db->connect();
    $db->query("SHOW TABLES LIKE '" . $tableName . "'");

    if ($db->existRows()) {
        if (JSON::isJson($data["attribute"])) {
            $data = $data["attribute"];
            
            $query = $db->query("ALTER TABLE `{$tableName}` ADD `{$data["name"]}` ".typeOfAttr($data["type"])." NOT NULL AFTER `w_id`, ADD `label_{$data["name"]}` VARCHAR(100) NOT NULL AFTER `{$data["name"]}`");

            
            if ($query) {
                JSON::set("message", "Success");
                die(JSON::get());
            } else {
                JSON::set("status", "400");
                JSON::set("message", "Database query error");
                die(JSON::get());
            }
        }else{
            JSON::set("status", "406");
            JSON::set("message", "JSON data is invalid");
            die(JSON::get());
        }
    }
    
    JSON::set("status", "400");
    JSON::set("message", "The table does not exists");
    die(JSON::get());
}

function typeOfAttr($attr){

    switch($attr){
        case "varchar":
            return "VARCHAR(100)";
            break;
        case "text":
            return "TEXT";
            break;
        case "number":
            return "INT";
            break;
        case "float":
            return "FLOAT";
            break;
        default:
            return "VARCHAR(100)";
    }

}

?>
