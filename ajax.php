<?php

use Orange\User;

session_start();
include_once('config.php');
require 'vendor/autoload.php';

if(isset($_GET['process']) && $_GET['process'] !== ''){
    if($_GET['process'] !== 'login-process' && !User::login_check()){
        //echo $_GET['process'];
        $message =json_encode([
            'respond' => 'No',
            'message' => 'Please refresh <script>location.reload();</script>',
        ]);
        echo json_encode([
            'status' => 'sessionexpired',
            'message' => $message,
        ]);
        header("Refresh:0");
    }else {
        if (file_exists(PROCESSES_PATH . $_GET['process'] . '.php')) {
            include_once(PROCESSES_PATH . $_GET['process'] . '.php');
        } else {
            echo '404: File ' . $_GET['process'] . ' not found';
        }
    }
}else{
    echo '404: Process not Found';
}

