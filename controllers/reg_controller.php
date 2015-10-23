<?php
class Reg_Controller
{
    public function registration($user_name, $user_surname, $user_login, $user_email, $user_password, $user_password_validation)
    {
        if ($user_password == $user_password_validation)
        {
            $poson = new User_Model();
            $poson->create($user_name, $user_surname, $user_login, $user_email, $user_password);
        }
        else
        {
            echo "passwords are not the same";
        }
    }
}