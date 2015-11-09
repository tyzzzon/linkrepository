<?php
class User_Controller
{
    public function registration_action()
    {
        if ($_POST["user_login"]=="" || $_POST["user_email"]=="" || $_POST["user_password"]=="")
        {
            echo '<script>alert("Not all required fields are filled");</script>';
            $this->registration_view_action();
        }
        else
        {
            if ($_POST["user_password"] == $_POST["user_password_confirm"])
            {
                $poson = new User_Model();
                $poson->user_name = $_POST["user_name"];
                $poson->user_surname = $_POST["user_surname"];
                $poson->user_login = $_POST["user_login"];
                $poson->user_email = $_POST["user_email"];
                $poson->user_password = $_POST["user_password"];
                if ($poson->create())
                {
                    $content_view = new Home_View();
                    $main_view = new Main_View();
                    $main_view->content_view = $content_view;
                    $main_view->render();
                }
            }
            else
            {
                echo '<script>alert("Passwords are not the same");</script>';
                $this->registration_view_action();
            }
        }
    }

    public function registration_view_action()
    {
        $content_view = new Registration_View();
        $main_view = new Main_View();
        $main_view->content_view = $content_view;
        $main_view->header_ar['Registration'] = 'user/registration_view';
        $main_view->render();
    }


    public function auth_view_action()
    {
        $content_view = new Auth_View();
        $main_view = new Main_View();
        $main_view->content_view = $content_view;
        $main_view->render();
    }

    public function authentication_action()
    {
        $user = new User_Model();
        if ($user->authentication($_POST["Login"], md5($_POST["Password"])))
        {
            $link_cont = new Link_Controller();
            $link_cont->link_look_action(true, true);
        }
        else
            $this->auth_view_action();
    }

    public function see_users_action()
    {
        $user=new User_Model();
        for ($i=0; $i<5; $i++)
        {
            $user->get_from_database("DK");
            $user->lets_see();
        }
    }

    public function check_link_action($link_hash)
    {
        $temp_link = new Temporary_Link_Model();
        $temp_link->check_link($link_hash);
        $main_view = new Main_View();
        $content_view = new Temp_Link_View();
        //$main_view->header_ar['Registration'] = '/user/registration_view';
        $main_view->content_view = $content_view;
        $main_view->render();
    }

    public function send_again_action()
    {
        $temp_link = new Temporary_Link_Model();
        $temp_link->create_temporary_link();
        $content_view = new Home_View();
        $main_view = new Main_View();
        $main_view->header_ar['Registration'] = 'user/registration_view';
        $main_view->content_view = $content_view;
        $main_view->render();
    }

    public function go_home_action()
    {
        $content_view = new Home_View();
        $main_view = new Main_View();
        $main_view->content_view = $content_view;
        $main_view->render();
    }

    public static function error404_action()
    {
        $content_view = new Error404_View();
        $main_view = new Main_View();
        $main_view->content_view = $content_view;
        $main_view->render();
    }

    public function users_list_action()
    {
        $content_view = new List_View();
        $helper_ar = array('User name', 'User surname', 'User login', 'User email', 'User role', 'User status');
        $user = new User_Model();
        $content_view->table_head = $helper_ar;
        for ($i = 0; $i < $user->get_number(); $i++)
        {
            $user->get_all($i);
            $edit_butt = new Edit_Butt_View();
            $delete_butt = new Delete_Butt_View();
            $edit_butt->user_login = $user->user_login;
            $delete_butt->user_id = $user->user_id;
            $helper_ar = array($user->user_name, $user->user_surname, $user->user_login,
                $user->user_email, $user->user_role, $user->user_status);
            array_push($content_view->edit_butt, $edit_butt);
            array_push($content_view->delete_butt, $delete_butt);
            array_push($content_view->table_body, $helper_ar);
        }
        $main_view = new Main_View();
        $main_view->content_view = $content_view;
        unset($main_view->header_ar['Registration']);
        unset($main_view->header_ar['Authentication']);
        $main_view->render();
    }

    public function edit_view_action($user_login)
    {
        $user = new User_Model();
        $user->get_from_database($user_login);
        $content_view = new Edit_View();
        $content_view->field_ar['User name'] = $user->user_name;
        $content_view->field_ar['User surname'] = $user->user_surname;
        $content_view->field_ar['User login'] = $user->user_login;
        $content_view->field_ar['User email'] = $user->user_email;
        $content_view->field_ar['User role'] = $user->user_role;
        $content_view->field_ar['User status'] = $user->user_status;
        $main_view = new Main_View();
        $main_view->content_view = $content_view;
        $main_view->render();
    }

    public function edit_action()
    {
        $user = new User_Model();
        $user->user_name = $_POST['User_name'];
        $user->user_surname = $_POST['User_surname'];
        $user->user_login = $_POST['User_login'];
        $user->user_email = $_POST['User_email'];
        $user->user_role = $_POST['User_role'];
        $user->user_status = $_POST['User_status'];
        if ($user->user_name === "" || $user->user_surname === "" || $user->user_login === "" || $user->user_email === "" ||
            $user->user_role === "" || $user->user_status ==="")
        {
            echo '<script>alert("Somthing is wrong");</script>';
            $this->edit_view_action($user->user_login);
        }
        else
        {
            $user->edit_user();
            $this->users_list_action();
        }

    }

    public function delete_action($user_id)
    {
        $user = new User_Model();
        $user->delete_user($user_id);
        $this->users_list_action();
    }
}