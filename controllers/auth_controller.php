<?php
class Auth_Controller
{
    public function authentification($user_login, $user_password)
    {
        $user = new User_Model();
        $user->authentification($user_login, $user_password);
    }
}