<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/database.php';
include_once '../objects/task.php';
 
$database = new Database();
$db = $database->getConnection();
 
$task = new Task($db);
 
$data = json_decode(file_get_contents("php://input"));

if (empty($data->name)) {
    echo '{';
        echo '"message": "Empty name. Task was not created."';
    echo '}';
    
    return;
}

$task->name = $data->name;
 
$res = $task->create();

if($res){
    echo '{';
        echo '"message": "Task was created.",';
        echo '"id":' . $res;
    echo '}';
}
else{
    echo '{';
        echo '"message": "Unable to create task."';
    echo '}';
}