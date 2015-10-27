<?php
class User_Controller
{
    public function registration($user_name, $user_surname, $user_login, $user_email, $user_password, $user_password_validation)
    {
        if ($user_password == $user_password_validation)
        {
            $poson = new User_Model();
            if ($poson->create($user_name, $user_surname, $user_login, $user_email, $user_password))
                echo "Check your e-mail for link";
        }
        else
        {
            echo "passwords are not the same";
        }
    }

    public function authentification($user_login, $user_password)
    {
        $user = new User_Model();
        $user->authentification($user_login, md5($user_password));
    }

    public function admin_edit_user($user_name, $user_surname, $user_login, $user_email, $user_password, $user_role)
    {
        if ($user_name === "" || $user_surname === "" || $user_login === "" || $user_email === "" || $user_password === "" ||
            $user_role === "")
        {
            echo "Smth is wrong";
        }
        else
        {
            $user = new User_Model();
            if ($user->get_from_database($user_login))
            {
                $user->user_name = $user_name;
                $user->user_surname = $user_surname;
                $user->user_email = $user_email;
                $user->user_password = $user_password;
                $user->user_role = $user_role;
                $user->edit_user();
            }
        }
    }

    public function user_edit_user($user_name, $user_surname, $user_login, $user_email, $user_password, $user_role)
    {
        if ($user_name === "" || $user_surname === "" || $user_login === "" || $user_email === "" || $user_password === "" ||
            $user_role === "")
        {
            echo "Smth is wrong";
        }
        else
        {
            $user = new User_Model();
            if ($user->get_from_database($user_login))
            {
                $user->user_name = $user_name;
                $user->user_surname = $user_surname;
                $user->user_email = $user_email;
                $user->user_password = $user_password;
                $user->edit_user();
            }
        }
    }
}