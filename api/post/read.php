<?php

header('Access-Control_Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../confug/Database.php';
include_once '../../models/User.php';

$database = new Database();
$db = $database->connect();

$user = new User($db);
$result = $user->read();
$num = $result->rowCount();

if(!!$num){
      
}