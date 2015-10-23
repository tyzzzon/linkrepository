<?php
class Admin_Edit_User_Controller
{
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
            $user->get_from_database($user_login);
            $user->user_name = $user_name;
            $user->user_surname = $user_surname;
            $user->user_email = $user_email;
            $user->user_password = $user_password;
            $user->user_role = $user_role;
            $user->edit_user($user_login);
        }
    }
}