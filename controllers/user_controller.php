<?php
class User_Controller
{
    public function registration_action()
    {
        if ($_POST["user_login"]=="" || $_POST["user_email"]=="" || $_POST["user_password"]=="")
        {
            echo "Not all required fields are filled";
            $view = new View();
            $view->render("registration");
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
                    $view = new View();
                    $view->render("index");
                }
            }
            else
            {
                echo "passwords are not the same<br>";
                $view = new View();
                $view->render("registration");
            }
        }
    }

    public function authentification_action()
    {
        $user = new User_Model();
        $user->authentification($_POST["Login"], md5($_POST["Password"]));
        $view = new View();
        $view->render("links");
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
        $temp_link->check_link($link_hash, "login@email.ru");
        include "views/temp_link_view.php";
    }

    public function send_again_action()
    {
        global $db;
        $row = $db->query("SELECT temporary_link_hash FROM temporary_links WHERE temporary_link_id = 214")->fetchAll(PDO::FETCH_ASSOC);
        mail("tyzzon@yandex.ru", "The link", "Hello there is the link: <a href='http://linkrepository/user/check_link/".$row[0]["temporary_link_hash"]."'>link".$row[0]["temporary_link_hash"]."</a>",
            "Content-type: text/html\r\n");
    }
}