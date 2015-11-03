<?php
class User_Controller
{
    public function registration_action()
    {
        if ($_POST["user_login"]=="" || $_POST["user_email"]=="" || $_POST["user_password"]=="")
        {
            echo "Not all required fields are filled";
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
                    $content_view = new Main_View();
                    $main_view = new Main_View();
                    $main_view->content_view = $content_view;
                    $main_view->render();
                }
            }
            else
            {
                echo "passwords are not the same<br>";
                $this->registration_view_action();
            }
        }
    }

    public function registration_view_action()
    {
        $content_view = new Registration_View();
        $main_view = new Main_View();
        $main_view->content_view = $content_view;
        $main_view->header_ar['Registration'] = '/user/registration_view';
        $main_view->render();
    }

    public function authentification_action()
    {
        $user = new User_Model();
        if ($user->authentification($_POST["Login"], md5($_POST["Password"])))
        {
            $content_view = new Links_View();
            $main_view = new Main_View();
            $main_view->content_view = $content_view;
            $main_view->ar['is_signed'] = true;
            $main_view->render();
        }
        else
            $form_string = "<div class='jumbotron'>
                <form class='navbar-form navbar-right' action='/user/authentification' method='post'>
                    <div class='form-group'>
                        <p>You are blocked! Send new link?</p>
                    </div>
                    <button type='submit' name='ok' class='btn btn-success'>Sign in</button>
                </form>
            </div>";
    }

    public function admin_edit_user_action($user_name, $user_surname, $user_login, $user_email, $user_password, $user_role)
    {
        if ($user_name === "" || $user_surname === "" || $user_login === "" || $user_email === "" || $user_password === "" ||
            $user_role === "")
        {
            echo "Smth is wrong<br>";
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

    public function user_edit_user_action($user_name, $user_surname, $user_login, $user_email, $user_password, $user_role)
    {
        if ($user_name === "" || $user_surname === "" || $user_login === "" || $user_email === "" || $user_password === "" ||
            $user_role === "")
        {
            echo "Smth is wrong<br>";
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
        $view = new Main_View();
        //$main_view->header_ar['Registration'] = '/user/registration_view';
        $view->render("temp_link");
    }

    public function send_again_action()
    {
        $temp_link = new Temporary_Link_Model();
        $temp_link->create_temporary_link();
        $content_view = new Home_View();
        $main_view = new Main_View();
        $main_view->header_ar['Registration'] = '/user/registration_view';
        $main_view->content_view = $content_view;
        $main_view->render("home");
    }

    public function go_home_action()
    {
        $content_view = new Home_View();
        $main_view = new Main_View();
        $main_view->content_view = $content_view;
        $main_view->render();
    }
}