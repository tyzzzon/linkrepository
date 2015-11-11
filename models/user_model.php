<?php
//require_once "autoload.php";
class User_Model extends Model
{
    public $user_id;
    public $user_name;
    public $user_surname;
    public $user_login;
    public $user_email;
    public $user_password;
    public $user_role_id = 3;
    public $user_status = "blocked";
    public $user_role;

    function __construct()
    {
        parent::__construct();
    }

    public function create()
    {
        global $db;
        $numb = $db->query("SELECT `user_id` FROM `users` WHERE `user_login` = '".$this->user_login."'")->rowCount();
        if ($numb)
        {
            echo '<script>alert("There is a user with such login");</script>';
            return false;
        }
        else
        {
            $numb = $db->query("SELECT `user_id` FROM `users` WHERE `user_email` = '".$this->user_email."'")->rowCount();
            if ($numb)
            {
                echo '<script>alert("There is a user with such email");</script>';
                return false;
            }
            else
            {
                echo '<script>alert("Everything is ok");</script>';
                $db->query("INSERT INTO users (user_name, user_surname, user_login, user_email, user_password, user_role_id,
user_status) VALUES ('" . $this->user_name . "', '" . $this->user_surname . "', '" . $this->user_login . "', '" . $this->user_email . "', '" . md5($this->user_password) .
                    "', '" . $this->user_role_id . "', '" . $this->user_status . "')");
                $get_id = $db->query("SELECT `user_id` FROM `users` WHERE `user_login` = '" . $this->user_login . "' AND
        `user_password` = '" . md5($this->user_password) . "'")->fetchAll(PDO::FETCH_ASSOC);
                $this->user_id = $get_id[0]["user_id"];
                $this->lets_see();
                $temp_link = new Temporary_Link_Model();
                $temp_link->create_temporary_link($this->user_id);
                return true;
            }
        }
    }

    public function lets_see()
    {
        if ($this->user_login == "" || $this->user_id == "" || $this->user_name == "" ||
            $this->user_surname == "" || $this->user_password == "" || $this->user_email == "")
        {
            echo '<script>alert("Nothing to write");</script>';
        }
        else
        {
            echo "Id: " . $this->user_id . "<br>";
            echo "Name: " . $this->user_name . "<br>";
            echo "Surname: " . $this->user_surname . "<br>";
            echo "User login: " . $this->user_login . "<br>";
            echo "Email: " . $this->user_email . "<br>";
            echo "Role: " . $this->user_role_id . "<br>";
            echo "Status: " . $this->user_status . "<br>";
        }
    }

    public function get_from_database($user_id)
    {
        global $db;
        $numb = $db->query("SELECT `user_id` FROM `users` WHERE `user_id` = ".$user_id)->rowCount();
        if ($numb) {
            $row = $db->query("SELECT `user_id`, `user_name`, `user_surname`, `user_login`,
`user_email`, `user_password`, `user_role_id`, `user_status` FROM `users` WHERE `user_id` = ".$user_id)->fetchAll(PDO::FETCH_ASSOC);
            $this->user_id = $row[0]["user_id"];
            $this->user_name = $row[0]["user_name"];
            $this->user_surname = $row[0]["user_surname"];
            $this->user_login = $row[0]["user_login"];
            $this->user_email = $row[0]["user_email"];
            $this->user_password = $row[0]["user_password"];
            $this->user_role_id = $row[0]["user_role_id"];
            $this->user_status = $row[0]["user_status"];
            $this->get_role();
            return true;
        }
        else
        {
            echo '<script>alert("There is no such user");</script>';
            return false;
        }
    }

    public function delete_user($user_id)
    {
        global $db;
        $numb = $db->query("SELECT `user_login` FROM `users` WHERE `user_id` = ".$user_id)->rowCount();
        if ($numb)
        {
            $db->query("DELETE FROM users WHERE user_id = " . $user_id);
            echo '<script>alert("Everything is ok");</script>';
        }
        else
        {
            echo '<script>alert("There is no such user");</script>';
        }
    }

    public function edit_user()
    {
        global $db;
        $numb = $db->query("SELECT `user_id` FROM `users` WHERE `user_login` = '".$this->user_login."'")->rowCount();
        $this->get_role_id();
        if ($numb)
        {
            $db->query("UPDATE users SET user_name = '".$this->user_name."', user_surname =
             '".$this->user_surname."', user_role_id = '".$this->user_role_id."', user_status =
              '".$this->user_status."', user_email = '".$this->user_email."'
              WHERE user_login = '". $this->user_login."'");
            echo '<script>alert("Everything is ok");</script>';
        }
        else
        {
            echo '<script>alert("There is no such user");</script>';
        }
    }

    public function authentication($user_login, $user_password)
    {
        global $db;
        $numb = $db->query("SELECT `user_id` FROM users WHERE user_login = '".$user_login."'")->rowCount();
        if ($numb)
        {
            $user = new User_Model();
            $row = $db->query('SELECT user_id FROM users WHERE user_login = "'.$user_login.'"')->fetchAll(PDO::FETCH_ASSOC);
            $user->get_from_database($row[0]['user_id']);
            if ($user_password == $user->user_password)
            {
                $row = $db->query("SELECT `user_status` FROM users WHERE user_login = '".$user_login."'")->fetchAll(PDO::FETCH_ASSOC);
                if ($row[0]["user_status"] == "blocked")
                {
                    echo '<script>alert("You are blocked.");</script>';
                    return false;
                }
                else
                {
                    $this->user_id = $db->query("SELECT `user_id` FROM users WHERE user_login = '".$user_login."'")->fetchAll(PDO::FETCH_ASSOC)[0]['user_id'];
                    return true;
                }
            }
            else
            {
                echo '<script>alert("Wrong password.");</script>';
                return false;
            }
        }
        else
        {
            echo '<script>alert("Wrong login.");</script>';
            return false;
        }
    }

    public function get_number()
    {
        global $db;
        $rows = $db->query("SELECT user_id FROM users")->rowCount();
        return $rows;
    }

    public function get_all($iter)
    {
        global $db;
        $row = $db->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
        $this->user_id = $row[$iter]["user_id"];
        $this->get_from_database($this->user_id);
    }

    public function get_role()
    {
        global $db;
        $this->user_role = $db->query("SELECT role_name FROM roles WHERE role_id = ".$this->user_role_id)->fetchAll(PDO::FETCH_ASSOC)[0]["role_name"];
    }

    public function get_role_id()
    {
        global $db;
        $this->user_role_id = $db->query("SELECT role_id FROM roles WHERE role_name = '".$this->user_role."'")->fetchAll(PDO::FETCH_ASSOC)[0]["role_id"];
    }
}