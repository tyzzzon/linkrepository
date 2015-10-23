<?php
require_once "core/model.php";
class User_Model extends Model
{
    public $user_id;
    public $user_name;
    public $user_surname;
    public $user_login;
    public $user_email;
    public $user_password;
    public $user_role = "user";
    public $user_status = "blocked";

    function __construct()
    {
        parent::__construct();
    }

    public function create($name, $surname, $user_login, $email, $password)
    {
        $db = new PDO('mysql:host=linkrepository;dbname=linkrepository', 'root', '111111');
        $numb = $db->query("SELECT `user_id`, `user_name`, `user_surname`, `user_login`,
`user_email`, `user_password`, `user_role`, `user_status` FROM `users`
WHERE `user_login` = '".$user_login."'")->rowCount();
        if ($numb)
        {
            echo "There is a user with such login<br>";
        }
        else
        {
            echo "Everything is ok <br>";
            $this->user_name = $name;
            $this->user_surname = $surname;
            $this->user_login = $user_login;
            $this->user_email = $email;
            $this->user_password = $password;
            $db->query("INSERT INTO users (user_name, user_surname, user_login, user_email, user_password, user_role,
user_status) VALUES ('" . $name . "', '" . $surname . "', '" . $user_login . "', '" . $email . "', '" . $password .
                "', '" . $this->user_role . "', '" . $this->user_status . "')");
            $get_id = $db->query("SELECT `user_id` FROM `users` WHERE `user_login` = '" . $user_login . "' AND
        `user_password` = '" . $password . "'")->fetchAll(PDO::FETCH_ASSOC);
            $this->user_id = $get_id[0]["user_id"];
            $this->lets_see();
            $temp_link = new Temporary_Link_Model();
            $temp_link->create_temporary_link($this->user_id, date("Y-m-d H:i"));
            echo $temp_link->temporary_link_id."<br>".$temp_link->temporary_link_hash."<br>".$temp_link->temporary_link_born_time."<br>".
                $temp_link->user_id."<br>";
            $temp_link->send_temporary_link();
        }
    }

    public function lets_see()
    {
        if ($this->user_login == "" || $this->user_id == "" || $this->user_name == "" ||
            $this->user_surname == "" || $this->user_password == "" || $this->user_email == "")
        {
            echo "Nothing to write<br>";
        }
        else
        {
            echo "Id: " . $this->user_id . "<br>";
            echo "Name: " . $this->user_name . "<br>";
            echo "Surname: " . $this->user_surname . "<br>";
            echo "User login: " . $this->user_login . "<br>";
            echo "Email: " . $this->user_email . "<br>";
            echo "Password: " . $this->user_password . "<br>";
            echo "Role: " . $this->user_role . "<br>";
            echo "Status: " . $this->user_status . "<br>";
        }
    }

    public function get_from_database($user_login)
    {
        $db = new PDO('mysql:host=linkrepository;dbname=linkrepository','root','111111');
        $row = $db->query("SELECT `user_id`, `user_name`, `user_surname`, `user_login`,
`user_email`, `user_password`, `user_role`, `user_status` FROM `users` WHERE `user_login` = '".$user_login."'")->fetchAll(PDO::FETCH_ASSOC);
        $numb = $db->query("SELECT `user_id`, `user_name`, `user_surname`, `user_login`,
`user_email`, `user_password`, `user_role`, `user_status` FROM `users`
WHERE `user_login` = '".$user_login."'")->rowCount();
        switch ($numb)
        {
            case 1:
                $this->user_id = $row[0]["user_id"];
                $this->user_name = $row[0]["user_name"];
                $this->user_surname = $row[0]["user_surname"];
                $this->user_login = $row[0]["user_login"];
                $this->user_email = $row[0]["user_email"];
                $this->user_password = $row[0]["user_password"];
                $this->user_role = $row[0]["user_role"];
                $this->user_status = $row[0]["user_status"];
                echo "Everything is ok<br>";
                break;
            case 0:
                echo "There is no such user<br>";
                break;
            default:
                echo "Smth is wrong...<br>";
                break;
        }
    }

    public function delete_user($user_login)
    {
        $db = new PDO('mysql:host=linkrepository;dbname=linkrepository','root','111111');
        $numb = $db->query("SELECT `user_id`, `user_name`, `user_surname`, `user_login`,
`user_email`, `user_password`, `user_role`, `user_status` FROM `users`
WHERE `user_login` = '".$user_login."'")->rowCount();
        switch ($numb)
        {
            case 1:
                $db->query("DELETE FROM users WHERE user_login = '".$user_login."'");
                echo "Everything is ok<br>";
                break;
            case 0:
                echo "There is no such user<br>";
                break;
            default:
                echo "Smth is wrong...<br>";
                break;
        }
    }

    public function edit_user($user_login)
    {
        $db = new PDO('mysql:host=linkrepository;dbname=linkrepository','root','111111');
        $numb = $db->query("SELECT `user_id`, `user_name`, `user_surname`, `user_login`,
`user_email`, `user_password`, `user_role`, `user_status` FROM `users`
WHERE `user_login` = '".$user_login."'")->rowCount();
        if ($numb)
        {
            $db->query("UPDATE users SET user_name = '".$this->user_name."', user_surname =
             '".$this->user_surname."', user_role = '".$this->user_role."', user_status =
              '".$this->user_status."' user_password = '".$this->user_password."' WHERE user_login = '". $this->user_login."'");
        }
        else
        {
            echo "There is no such user<br>";
        }
    }

    public function authentification($user_login, $user_password)
    {
        $db = new PDO('mysql:host=linkrepository;dbname=linkrepository','root','111111');
        $numb = $db->query("SELECT `user_id` FROM users WHERE user_login = '".$user_login."'")->rowCount();
        if ($numb)
        {
            $user = new User_Model();
            $user->get_from_database($user_login);
            if ($user_password == $user->user_password)
            {
                echo "Success!";
            }
            else
            {
                echo "Wrong password";
            }
        }
        else
        {
            echo "Wrong login";
        }
    }
}