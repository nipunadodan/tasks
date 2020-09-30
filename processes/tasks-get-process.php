<?php
use Orange\Db;

$tasks = (new Db)->select('tasks',[
    '[>]status' => ['status' => 'ID'],
    '[>]types' => ['type' => 'ID'],
    '[>]users' => ['created_by' => 'id'],
],[
    'tasks.ID',
    'tasks.title',
    'tasks.description',
    'tasks.category',
    'tasks.priority',
    'tasks.created_by',
    'tasks.updated_at',
    'status.title(status)',
    'types.title(type)',
    'users.username',
    ],[
    'ORDER' => ['tasks.updated_at'=> 'DESC']
]);

//$tasks = (new Db)->select('tasks','*');

// print_r($tasks);

if(!empty($tasks))
    $return = [
        'message' => json_encode($tasks),
        'status' => 'success'
    ];
else
    $return = [
        'message' => 'No results found',
        'status' => 'danger'
    ];

print_r(json_encode($return));
