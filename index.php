<?php 

error_reporting(0);

require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/Config/config.php";
require_once __DIR__ . "/Database/Mysql.class.php";
require_once __DIR__ . "/Class/DocumentWrite.class.php";
require_once __DIR__ . "/Class/Json.class.php";
require_once __DIR__ . "/Class/User.class.php";
require_once __DIR__ . "/Class/Body.class.php";
require_once __DIR__ . "/Auth/authorization.php";

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');

// Use this namespace
use Steampixel\Route;

Authorization::auth();

// Add your first route
Route::add("/", function() {
    require_once __DIR__."/Template/Documentation/index.html";
},['get']);

Route::add("/setup", function() {
    require_once __DIR__ . "/Installation/installation.php";
    setup();
},['get']);

Route::add("/api/get/table", function() {
    require_once __DIR__ . "/API/API_GetTable.php";
    API_GetTable();
},['get']);

Route::add("/api/post/table", function() {
    require_once __DIR__ . "/API/API_CreateTable.php";
    API_CreateTable();
},['post']);

Route::add("/api/delete/table", function() {
    require_once __DIR__ . "/API/API_DeleteTable.php";
    API_DeleteTable();
},['delete']);

Route::add("/api/post/attribute", function() {
    require_once __DIR__ . "/API/API_CreateAttribute.php";
    API_CreateAttribute();
},['post']);

Route::add("/api/get/data/([a-z0-9]*)", function($arg) {
    require_once __DIR__ . "/API/API_GetDataTable.php";
    API_GetDataTable($arg,null);
},['get']);

Route::add("/api/get/data/([a-z0-9]*)/([0-9]+(,[0-9]+)*)", function($arg,$id) {
    require_once __DIR__ . "/API/API_GetDataTable.php";
    API_GetDataTable($arg,$id);
},['get']);

Route::add("/api/delete/data/([a-z0-9]*)", function($arg) {
    require_once __DIR__ . "/API/API_DeleteDataTable.php";
    API_DeleteDataTable($arg);
},['delete']);

// Run the router
Route::run("/");

?>
