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
        global $db;
        $this->get_from_database($user_id);
        $numb = $db->query("SELECT `temporary_link_id` FROM `temporary_links` WHERE `user_id` = ".$user_id)->rowCount();
        if ($numb)
        {
            echo '<script>alert("There is a temporary link for this user!");</script>';
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
            echo '<script>alert("Check your email for temporary link");</script>';
            $this->send_temporary_link();
        }
    }


    public function get_from_database($user_id)
    {
        global $db;
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
            echo '<script>alert("There is no link for that user");</script>';
            return false;
        }
    }

    public function delete_link($user_id)
    {
        global $db;
        $numb = $db->query("SELECT `temporary_link_id` FROM `temporary_links` WHERE `user_id` = ".$user_id)->rowCount();
        if ($numb)
        {
            $db->query("DELETE FROM temporary_links WHERE user_id =".$user_id);
        }
        else
        {
            echo '<script>alert("There is no link for that user");</script>';
        }
    }

    public function send_temporary_link()
    {
        mail("tyzzon@yandex.ru", "The link", "Hello there is the link: <a href='http://linkrepository/user/check_link/".$this->temporary_link_hash."'>link</a>",
            'MIME-Version: 1.0' . "\r\n" .'Content-type: text/html; charset=iso-8859-1' . "\r\n");
    }

    public function check_link($temporary_link_hash)
    {
        global $db;
        $numb = $db->query("SELECT `user_id` FROM `temporary_links` WHERE `temporary_link_hash` = '".
            $temporary_link_hash."'")->rowCount();
        if ($numb)
        {
                $link = new Temporary_Link_Model();
                $link->get_from_database($db->query("SELECT `user_id` FROM `temporary_links` WHERE `temporary_link_hash` = '" .
                    $temporary_link_hash . "'")->fetchAll(PDO::FETCH_ASSOC)[0]["user_id"]);
                    $link->check_time_link();
        }
        else
        {
            echo '<script>alert("invalid link");</script>';
        }
    }

    public function check_time_link()
    {
        global $db;
        $ids = $db->query("SELECT temporary_link_born_time, user_id FROM temporary_links")->fetchAll(PDO::FETCH_ASSOC);
        for ($i=0;$i<count($ids);$i++)
        {
            global $life_time;
            $data_now = explode("/", date("Y/m/d/H/i"));
            $data_born = explode("/", str_replace(":", "/", str_replace(" ", "/", str_replace("-", "/", $ids[$i]["temporary_link_born_time"]))));
            if (mktime($data_now[3], $data_now[4], 0, $data_now[1], $data_now[2], $data_now[0]) - mktime($data_born[3],
                    $data_born[4], 0, $data_born[1], $data_born[2], $data_born[0]) > $life_time)
            {
                $this->delete_link($ids[$i]["user_id"]);
            }
            else
            {
                $db->query("UPDATE users SET user_status = 'active' WHERE user_id = '". $this->user_id."'");
                $this->delete_link($this->user_id);
            }
        }
    }
}