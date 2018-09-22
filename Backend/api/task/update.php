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

$task->id = $data->id;
$task->deleted = empty($data->deleted) ? 0 : 1;
 
if($task->update()){
    echo '{';
        echo '"message": "Task was updated."';
    echo '}';
}
else{
    echo '{';
        echo '"message": "Unable to update task."';
    echo '}';
}

