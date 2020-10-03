<?php

use Orange\Db;

$tasks = (new Db)->insert("tasks", [
    "title" => $_POST['title'],
    "description" => $_POST['description'],
    "category" => $_POST['category'],
    "status" => 5,
    "priority" => $_POST['priority'],
    "linked_tasks" => 0,
    "type" => $_POST['type'],
    "updated_by" => $_SESSION['user_id'],
    "created_by" => $_SESSION['user_id'],
]);

if($tasks){
    $return = json_encode([
        'status' => 'success',
        'message' => 'Successfully inserted',
    ]);
}else{
    $return = json_encode([
        'status' => 'danger',
        'message' => 'Successfully inserted',
    ]);
}
print_r($return);
