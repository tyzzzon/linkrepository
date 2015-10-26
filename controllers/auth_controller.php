<?php
//require_once "autoload.php";
class Auth_Controller
{
    public function __construct()
    {
    }

    public function authentification($user_login, $user_password)
    {
        $user = new User_Model();
        $user->authentification($user_login, md5($user_password));
    }
}