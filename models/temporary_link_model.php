<?php
#require_once "models/user_model.php";
class Temporary_Link_Model
{
    public $temporary_link_id;
    public $user_id;
    public $temporary_link_hash;
    public $temporary_link_born_time;

    public function create_temporary_link($user_id)
    {
        $db = new PDO('mysql:host=linkrepository;dbname=linkrepository','root','111111');
        $numb = $db->query("SELECT `temporary_link_id` FROM `temporary_links` WHERE `user_id` = ".$user_id)->rowCount();
        if ($numb)
        {
            echo "There is a temporary link for this user!<br>";
            $this->get_from_database($user_id);
            $this->check_time_link();
        }
        else
        {
            $temporary_link_born_date = date("Y-m-d H:i");
            $this->temporary_link_hash = sha1(uniqid($this->user_id, true));
            $db->query("INSERT INTO temporary_links (user_id, temporary_link_hash, temporary_link_born_time)
VALUES (" . $user_id . ", '" . $this->temporary_link_hash . "', '" . $temporary_link_born_date . "')");
            $this->user_id = $user_id;
            $this->temporary_link_born_time = $temporary_link_born_date;
            $get_id = $db->query("SELECT `temporary_link_id` FROM `temporary_links` WHERE `user_id` = " .
                $user_id)->fetchAll(PDO::FETCH_ASSOC);
            $this->temporary_link_id = $get_id[0]["temporary_link_id"];
            echo "Check your email for temporary link<br>";
        }
    }


    public function get_from_database($user_id)
    {
        $db = new PDO('mysql:host=linkrepository;dbname=linkrepository','root','111111');
        $numb = $db->query("SELECT `temporary_link_id` FROM `temporary_links` WHERE `user_id` = ".$user_id)->rowCount();
        if ($numb)
        {
            $link_row = $db->query("SELECT `temporary_link_id`, `user_id`, `temporary_link_hash`,
`temporary_link_born_time` FROM `temporary_links` WHERE `user_id` = " . $user_id)->fetchAll(PDO::FETCH_ASSOC);
            $this->temporary_link_id = $link_row[0]["temporary_link_id"];
            $this->user_id = $link_row[0]["user_id"];
            $this->temporary_link_hash = $link_row[0]["temporary_link_hash"];
            $this->temporary_link_born_time = $link_row[0]["temporary_link_born_time"];
            return true;
        }
        else
        {
            echo "There is no link for that user";
            return false;
        }
    }

    public function delete_link($user_id)
    {
        $db = new PDO('mysql:host=linkrepository;dbname=linkrepository','root','111111');
        $numb = $db->query("SELECT `temporary_link_id` FROM `temporary_links` WHERE `user_id` = ".$user_id)->rowCount();
        if ($numb)
        {
            $db->query("DELETE FROM temporary_links WHERE user_id =".$user_id);
        }
        else
        {
            echo "There is no link for that user";
        }
    }

    public function send_temporary_link()
    {
        mail("tyzzon@yandex.ru", "The link", "Hello there is the link: ".$this->temporary_link_hash);
    }

    public function check_link($temporary_link_hash, $user_email)
    {
        $db = new PDO('mysql:host=linkrepository;dbname=linkrepository','root','111111');
        $numb = $db->query("SELECT `user_id` FROM `temporary_links` WHERE `temporary_link_hash` = '".
            $temporary_link_hash."'")->rowCount();
        if ($numb)
        {
            $numb = $db->query("SELECT `user_id` FROM `users` WHERE `user_email` = '".
                $user_email."'")->rowCount();
            if ($numb)
            {
                $link = new Temporary_Link_Model();
                $link->get_from_database($db->query("SELECT `user_id` FROM `temporary_links` WHERE `temporary_link_hash` = '" .
                    $temporary_link_hash . "'")->fetchAll(PDO::FETCH_ASSOC)[0]["user_id"]);
                $user_id = $db->query("SELECT user_id FROM users WHERE user_email = '" .
                    $user_email . "'")->fetchAll(PDO::FETCH_ASSOC)[0]["user_id"];
                if ($user_id == $link->user_id)
                {
                    $link->check_time_link();
                }
                else
                {
                    echo "The link isn't yours!!";
                }
            }
            else
            {
                echo "There is no user with such e-mail";
            }
        }
        else
        {
            echo "invalid link";
        }
    }

    public function check_time_link()
    {
        $db = new PDO('mysql:host=linkrepository;dbname=linkrepository','root','111111');
        for ($i=1;$i<5;$i++)
            echo $i;
        $delta = 10;
        $data_now = explode("/", date("Y/m/d/H/i"));
        $data_born = explode("/", str_replace(":", "/", str_replace(" ", "/", str_replace("-", "/", $this->temporary_link_born_time))));
        if (mktime($data_now[3], $data_now[4], 0, $data_now[1], $data_now[2], $data_now[0]) - mktime($data_born[3],
                $data_born[4], 0, $data_born[1], $data_born[2], $data_born[0]) > $delta)
        {
            $this->delete_link($this->user_id);
            //$this->create_temporary_link($this->user_id);
        }
//        else
//        {
//            $user = new User_Model();
//            $user_login = $db->query("SELECT user_login FROM users WHERE user_id = ".
//                $this->user_id)->fetchAll(PDO::FETCH_ASSOC)[0]["user_login"];
//            $user->get_from_database($user_login);
//            $user->user_status = "active";
//            //$user->edit_user();
//            //$this->delete_link($this->user_id);
//        }
    }
}