<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/task.php';

$database = new Database();
$db = $database->getConnection();

$task = new Task($db);

$stmt = $task->read();
$num = $stmt->rowCount();

if ($num > 0)
{

    $tasks_arr = array();
    $tasks_arr["data"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {

        extract($row);

        $tasks_item = array(
            "id" => $id,
            "name" => html_entity_decode($name),
            "deleted" => !empty($deleted),
        );

        array_push($tasks_arr["data"], $tasks_item);
    }

    echo json_encode($tasks_arr);
} else
{
    echo json_encode(
            array("message" => "No tasks found.")
    );
}
