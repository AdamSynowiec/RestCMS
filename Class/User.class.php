<?php

    class User
    {
        public static function getClientIP()
        {
            $ipaddress = '';
            if (isset($_SERVER['HTTP_CLIENT_IP'])) {
                $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
            } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
                $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
            } else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
                $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
            } else if (isset($_SERVER['HTTP_FORWARDED'])) {
                $ipaddress = $_SERVER['HTTP_FORWARDED'];
            } else if (isset($_SERVER['REMOTE_ADDR'])) {
                $ipaddress = $_SERVER['REMOTE_ADDR'];
            } else {
                $ipaddress = 'UNKNOWN';
            }

            return $ipaddress;
        }

        public static function getGeolocationData($ipaddress)
        {
            $json = file_get_contents("http://ipinfo.io/{$ipaddress}/geo");
            $data = json_decode($json, true);
            return $data;
        }

        public static function getCountry()
        {
            $ipaddress = self::getClientIP();
            $data = self::getGeolocationData($ipaddress);
            return isset($data['country']) ? $data['country'] : 'UNKNOWN';
        }

        public static function getRegion()
        {
            $ipaddress = self::getClientIP();
            $data = self::getGeolocationData($ipaddress);
            return isset($data['region']) ? $data['region'] : 'UNKNOWN';
        }

        public static function getCity()
        {
            $ipaddress = self::getClientIP();
            $data = self::getGeolocationData($ipaddress);
            return isset($data['city']) ? $data['city'] : 'UNKNOWN';
        }
    }

?>