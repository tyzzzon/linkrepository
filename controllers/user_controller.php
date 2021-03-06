<?php
class User_Controller
{
    public function registration_action()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            echo '<script>alert("Access denied")</script>';
            $this->go_home_action();
        }
        else
        {
            if ($_POST["user_login"] == "" || $_POST["user_email"] == "" || $_POST["user_password"] == "")
            {
                echo '<script>alert("Not all required fields are filled");</script>';
                $this->reg_view_action();
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
                    $this->reg_view_action();
                }
            }
        }
    }

    public function reg_view_action()
    {
            $content_view = new Registration_View();
            $main_view = new Main_View();
            $main_view->content_view = $content_view;
            unset($main_view->header_ar['user/reg_view']);
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
        if ($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            echo '<script>alert("Access denied")</script>';
            $this->go_home_action();
        }
        else
        {
            $user = new User_Model();
            if ($user->authentication($_POST["Login"], md5($_POST["Password"]))) {
                $link_cont = new Link_Controller();
                $_SESSION['uid'] = $user->user_id;
                $link_cont->list_action(1);
            }
            else
                $this->auth_view_action();
        }
    }

    public function check_link_action($link_hash)
    {
            $temp_link = new Temporary_Link_Model();
            $temp_link->check_link($link_hash);
            $main_view = new Main_View();
            $content_view = new Temp_Link_View();
            $main_view->content_view = $content_view;
            $main_view->render();
    }

    public function send_again_action()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            echo '<script>alert("Access denied")</script>';
            $this->go_home_action();
        }
        else
        {
            $temp_link = new Temporary_Link_Model();
            $temp_link->create_temporary_link();
            $content_view = new Home_View();
            $main_view = new Main_View();
            $main_view->header_ar['Registration'] = 'user/registration_view';
            $main_view->content_view = $content_view;
            $main_view->render();
        }
    }

    public function go_home_action()
    {
        $user = new User_Model();
            $content_view = new Home_View();
            $main_view = new Main_View();
        if (isset($_SESSION['uid']))
        {
            unset($main_view->header_ar['user/reg_view']);
            unset($main_view->header_ar['user/auth_view']);
            if ($user->permission('edit_all_users'))
            {
                $main_view->header_ar['user/list/1'] = array('value' => 'User list', 'id' => 'list-link');
            }
            $main_view->header_ar['link/link_create_view'] = array('value' => 'Create link', 'id' => 'create-link');
            $main_view->header_ar['link/my_list/1'] = array('value' => 'My links', 'id' => 'my-links');
            $main_view->header_ar['user/edit_view/'.$_SESSION['uid']] = array('value' => 'Edit profile', 'id' => 'edit-profile');
            $main_view->header_ar[''] = array('value' => 'Log out', 'id' => 'logout_btn');
        }
            $main_view->content_view = $content_view;
            $main_view->render();
    }

    public static function error404_action()
    {
        $user = new User_Model();
            $content_view = new Error404_View();
            $main_view = new Main_View();
        if (isset($_SESSION['uid']))
        {
            unset($main_view->header_ar['user/reg_view']);
            unset($main_view->header_ar['user/auth_view']);
            if ($user->permission('edit_all_users'))
            {
                $main_view->header_ar['user/list/1'] = array('value' => 'User list', 'id' => 'list-link');
            }
            $main_view->header_ar['link/link_create_view'] = array('value' => 'Create link', 'id' => 'create-link');
            $main_view->header_ar['link/my_list/1'] = array('value' => 'My links', 'id' => 'my-links');
            $main_view->header_ar['user/edit_view/'.$_SESSION['uid']] = array('value' => 'Edit profile', 'id' => 'edit-profile');
            $main_view->header_ar['#'] = array('value' => 'Log out', 'id' => 'logout_btn');
        }
            $main_view->content_view = $content_view;
            $main_view->render();
    }

    public function users_list_action($page, $numb_of_pages)
    {
        global $items_on_page;
        $content_view = new List_View();
        $helper_ar = array('User name', 'User surname', 'User login', 'User email', 'User role', 'User status');
        for ($i=0;$i<$numb_of_pages;$i++)
            array_push($content_view->pagination, '/user/list/'.($i+1));
        $user = new User_Model();
        $content_view->table_head = $helper_ar;
        for ($i = 0; $i < $items_on_page; $i++)
        {
            $user->get_all($i, ($page-1)*($items_on_page));
            if(!empty($user->user_name))
            {
                $edit_butt = new Edit_Butt_View();
                $delete_butt = new Delete_Butt_View();
                $edit_butt->action = "/user/edit_view/" . $user->user_id;
                $delete_butt->id = $user->user_id;
                $helper_ar = array($user->user_name, $user->user_surname, $user->user_login,
                    $user->user_email, $user->user_role, $user->user_status);
                $user->clean();
                array_push($content_view->edit_butt, $edit_butt);
                array_push($content_view->delete_butt, $delete_butt);
                array_push($content_view->table_body, $helper_ar);
            }
        }
        $main_view = new Main_View();
        $content_view->delete_url = "/user/delete/";
        $main_view->content_view = $content_view;
        unset($main_view->header_ar['user/reg_view']);
        unset($main_view->header_ar['user/auth_view']);
        if ($user->permission('edit_all_users'))
            $main_view->header_ar['user/list/1'] = array('value' => 'User list', 'id' => 'list-link');
        $main_view->header_ar['link/link_create_view'] = array('value' => 'Create link', 'id' => 'create-link');
        $main_view->header_ar['link/my_list/1'] = array('value' => 'My links', 'id' => 'my-links');
        $main_view->header_ar['user/edit_view/'.$_SESSION['uid']] = array('value' => 'Edit profile', 'id' => 'edit-profile');
        $main_view->header_ar['#'] = array('value' => 'Log out', 'id' => 'logout_btn');
        $main_view->render();
    }

    public function edit_view_action($user_id)
    {
            $user = new User_Model();
            $user->get_from_database($user_id);
            $content_view = new Edit_View();
            $content_view->field_ar['User name'] = array ($user->user_name, '');
            $content_view->field_ar['User surname'] = array ($user->user_surname, '');
            $content_view->field_ar['User login'] = array ($user->user_login, 'disabled');
            $content_view->field_ar['User email'] = array ($user->user_email, 'disabled');
        if (!$user->permission('edit_all_users'))
        {
            $content_view->field_ar['User role'] = array($user->user_role, 'disabled');
        }
        else
        {
            $content_view->field_ar['User role'] = array($user->user_role, '');
            $content_view->field_ar['User status'] = array($user->user_status, '');
        }
            $content_view->action = "/user/edit/".$user_id;
            $main_view = new Main_View();
        unset($main_view->header_ar['user/reg_view']);
        unset($main_view->header_ar['user/auth_view']);

            $main_view->content_view = $content_view;
            $main_view->render();
    }

    public function edit_action($user_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            echo '<script>alert("Access denied")</script>';
            $this->go_home_action();
        }
        else
        {
            $user = new User_Model();
            $user->get_from_database($user_id);
            $user->user_name = $_POST['User_name'];
            $user->user_surname = $_POST['User_surname'];
//            $user->user_login = $_POST['User_login'];
//            $user->user_email = $_POST['User_email'];
            if ($user->permission('edit_all_users'))
            {
                $user->user_role = $_POST['User_role'];
                $user->user_status = $_POST['User_status'];
            }
            if ($user->user_name === "" || $user->user_surname === "" || $user->user_login === "" || $user->user_email === "" ||
                $user->user_role === "" || $user->user_status === "")
            {
                echo '<script>alert("Somthing is wrong");</script>';
                $this->edit_view_action($user_id);
            }
            else
            {
                $user->edit_user($user_id);
                $this->go_home_action();
            }
        }

    }

    public function delete_action($user_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            echo '<script>alert("Access denied")</script>';
            $this->go_home_action();
        }
        else
        {
            $user = new User_Model();
            $user->delete_user($user_id);
        }
    }

    public function log_out_action()
    {
        unset($_SESSION['uid']);
        session_destroy();
    }

    public function list_action($page)
    {
        $user = new User_Model();
        $pages = $user->pages_numb();
        $this->users_list_action($page, $pages);
    }
}