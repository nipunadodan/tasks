<?php

namespace Orange;

class User{
    public $url;
    function login($username, $password){
        $user = (new Db)->select('users','*',[
            'username' => $username
        ]);
        if (password_verify($password, $user[0]['password'])) {
            return [
                'login' => true,
                'user_id' => $user[0]['id'],
                'username' => $user[0]['username']
            ];
        }else{
            return false;
        }
    }

    public static function login_check(){
        if(isset($_SESSION, $_SESSION['login'], $_SESSION['user_id']) && $_SESSION['login'] == 'Ok' && $_SESSION['user_id'] !== ''){
            return true;
        }else{
            return false;
        }
    }
}
