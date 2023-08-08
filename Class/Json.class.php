<?php

    class JSON {

        private static $data = array();

        public static function set($key, $value) {
            if(JSON::isJson($value)){
                self::$data[$key] = json_decode($value);
            }else{
                self::$data[$key] = $value;
            }

            if($key === "status"){
                http_response_code($value);
            }
        }

        public static function get() {
            header('Content-type: application/json');
            return json_encode(self::$data);
        }

        public static function isJson($string){

            if(gettype($string) === "array"){
                $decodedData = $string;
            }else{
                $decodedData = json_decode($string);
            }
            
            return json_last_error() === JSON_ERROR_NONE && (is_array($decodedData) || is_object($decodedData));
        }

    }

?>