<?php

    class Authorization {
        
        public static function auth(){

            if(isset($_GET['auth'])){

                $authKey = htmlspecialchars($_GET['auth']);

                if($authKey !== Config::apiKey()){
                    http_response_code(401);

                    JSON::set('status', '401');
                    JSON::set('message', 'Unauthorized');

                    die(JSON::get());
                }

            }else{
                http_response_code(401);
                JSON::set('status', '401');
                JSON::set('message', 'Unauthorized');
                
                die(JSON::get());
            }

        }

    }

?>