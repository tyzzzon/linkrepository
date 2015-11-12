<?php
require_once "core/model.php";
class Link_Model extends Model
{
    public $link_id;
    public $link_name;
    public $link_url;
    public $link_description;
    public $link_private_status;
    public $link_born_time;
    public $user_id;
    public $user_login;

    function __construct()
    {
        parent::__construct();
    }

    public function create()
    {
        global $db;
        $numb = $db->query("SELECT `link_name` FROM `links` WHERE `link_url` = '".$this->link_url."' AND user_id =
".$this->user_id)->rowCount();
        if ($numb)
        {
            echo '<script>alert("There is a link with such url");</script>';
            return false;
        }
        else
        {
            echo '<script>alert("Everything is ok");</script>';
            $db->query("INSERT INTO links (`link_name` ,  `link_url` ,  `link_description` ,  `link_private_status` ,
`link_born_time` , `user_id`) VALUES ('" . $this->link_name . "', '" . $this->link_url . "', '" .
                $this->link_description . "', '" . $this->link_private_status . "', '" . date("Y-m-d H:i") . "', '" . $this->user_id . "')");
            $get_id = $db->query("SELECT `link_id` FROM `links` WHERE `link_url` = '" . $this->link_url . "' AND
        `user_id` = '" . $this->user_id . "'")->fetchAll(PDO::FETCH_ASSOC);
            $this->link_id = $get_id[0]["link_id"];
            return true;
        }
    }

    public function get_from_database($link_id)
    {
        global $db;
        $numb = $db->query('SELECT  `link_name` FROM  `links` WHERE  `link_id` ='.$link_id)->rowCount();
        if ($numb)
        {
            $row = $db->query("SELECT `link_id`, `link_name` ,  `link_url` ,  `link_description` ,  `link_private_status` ,
`link_born_time` , `user_id` FROM `links` WHERE `link_id` = ".$link_id)->fetchAll(PDO::FETCH_ASSOC);
            $this->link_url = $row[0]["link_url"];
            $this->link_name = $row[0]["link_name"];
            $this->link_description = $row[0]["link_description"];
            $this->link_private_status = $row[0]["link_private_status"];
            $this->link_born_time = $row[0]["link_born_time"];
            $this->user_id = $row[0]["user_id"];
            $this->user_login = $db->query('SELECT user_login FROM users WHERE user_id = '.$this->user_id)->fetchAll(PDO::FETCH_ASSOC)[0]['user_login'];
            echo '<script>alert("Everything is ok");</script>';
            return true;
        }
        else
        {
            echo '<script>alert("There is no such link");</script>';
            return false;
        }
    }

    public function lets_see($link_url, $user_id)
    {
        $this->get_from_database($link_url, $user_id);
            echo "Name: " . $this->link_name . "<br>";
            echo "URL: " . $this->link_url . "<br>";
            echo "Description: " . $this->link_description . "<br>";
            echo "Private status: " . $this->link_private_status . "<br>";
    }

    public function delete_link($link_id)
    {
        global $db;
        $numb = $db->query("SELECT `link_name` FROM `links` WHERE `link_id` = ".$link_id)->rowCount();
        switch ($numb)
        {
            case 1:
                $db->query("DELETE FROM links WHERE `link_id` = ".$link_id);
                echo '<script>alert("Everything is ok");</script>';
                break;
            case 0:
                echo '<script>alert("There is no such user");</script>';
                break;
            default:
                echo '<script>alert("Smth is wrong...");</script>';
                break;
        }
    }
    //могут быть одинаковые ссылки у разных пользователей
    public function edit_link()
    {
        global $db;
        $this->user_id = $db->query('SELECT user_id FROM users WHERE user_login = "'.$this->user_login.'"')->fetchAll(PDO::FETCH_ASSOC)[0]['user_id'];
        $numb = $db->query("SELECT link_name FROM `links` WHERE `link_url` = '".$this->link_url."'AND user_id =".$this->user_id)->rowCount();
        if ($numb)
        {
            $db->query("UPDATE links SET link_name = '".$this->link_name."', link_description = '".$this->link_description."', link_private_status =
              ".$this->link_private_status." WHERE `link_url` = '".$this->link_url."'AND user_id =".$this->user_id);
            echo '<script>alert("Everithing is ok");</script>';
        }
        else
        {
            echo '<script>alert("There is no such link");</script>';
        }
    }

    public function link_look($private_rights)
    {
        global $db;
        if ($private_rights)
        {
            $rows = $db->query("SELECT DISTINCT link_name, link_url, link_description, link_private_status FROM
links")->fetchAll(PDO::FETCH_ASSOC);
            for ($i = 0; $i < count($rows); $i++)
            {
                echo "Link name = ".$rows[$i]["link_name"]." link url = ".$rows[$i]["link_url"]." link description = ".
                    $rows[$i]["link_description"]." link private status = ".$rows[$i]["link_private_status"]."<br>";
            }
        }
        else
        {
            $rows = $db->query("SELECT DISTINCT link_name, link_url, link_description FROM links WHERE
link_private_status = 0")->fetchAll(PDO::FETCH_ASSOC);
            for ($i = 0; $i < count($rows); $i++)
            {
                echo "Link name = ".$rows[$i]["link_name"]." link url = ".$rows[$i]["link_url"]." link description = ".
                    $rows[$i]["link_description"]."<br>";
            }
        }
    }

    public function my_link_look($user_id, $iter)
    {
        global $db;
        $rows = $db->query("SELECT DISTINCT link_id, link_name, link_url, link_description, link_born_time, link_private_status,
user_id FROM links WHERE user_id = " . $user_id)->fetchAll(PDO::FETCH_ASSOC);
        $this->link_name = $rows[$iter]['link_name'];
        $this->link_url = $rows[$iter]['link_url'];
        $this->link_description = $rows[$iter]['link_description'];
        $this->link_private_status = $rows[$iter]['link_private_status'];
        $this->link_born_time = $rows[$iter]['link_born_time'];
        $this->link_id = $rows[$iter]['link_id'];
        $this->user_id = $rows[$iter]['user_id'];
    }

    public function get_number($private)
    {
        global $db;
        if ($private)
            $rows = $db->query("SELECT link_id FROM links")->rowCount();
        else
            $rows = $db->query("SELECT link_id FROM links WHERE link_private_status = 0")->rowCount();
        return $rows;
    }

    public function get_my_number()
    {
        global $db;
        $rows = $db->query("SELECT link_id FROM links WHERE user_id = ".$_SESSION['uid'])->rowCount();
        return $rows;
    }

    public function get_all($private, $iter, $down)
    {
        global $db;
        global $items_on_page;
        if ($private)
        {
            $row = $db->query("SELECT * FROM links LIMIT ".$down.", ".($items_on_page))->fetchAll(PDO::FETCH_ASSOC);
            if (isset($row[$iter]))
            {
                $this->link_id = $row[$iter]["link_id"];
                $this->link_name = $row[$iter]["link_name"];
                $this->link_url = $row[$iter]["link_url"];
                $this->link_description = $row[$iter]["link_description"];
                $this->link_private_status = $row[$iter]["link_private_status"];
                $this->link_born_time = $row[$iter]["link_born_time"];
                $this->user_login = $db->query("SELECT user_login FROM users WHERE user_id = " . $row[$iter]["user_id"])->fetchAll(PDO::FETCH_ASSOC)[0]["user_login"];
            }
        }
        else
        {
            $row = $db->query("SELECT * FROM links WHERE link_private_status = 0 LIMIT ".$down.", ".($items_on_page))->fetchAll(PDO::FETCH_ASSOC);
            if (isset($row[$iter]))
            {
                $this->link_id = $row[$iter]["link_id"];
                $this->link_name = $row[$iter]["link_name"];
                $this->link_url = $row[$iter]["link_url"];
                $this->link_description = $row[$iter]["link_description"];
                $this->link_born_time = $row[$iter]["link_born_time"];
                $this->user_login = $db->query("SELECT user_login FROM users WHERE user_id = " . $row[$iter]["user_id"])->fetchAll(PDO::FETCH_ASSOC)[0]["user_login"];
            }
        }
    }

    public function get_id()
    {
        global $db;
        $this->user_id = $db->query('SELECT user_id FROM users WHERE user_login = "'.$this->user_login.'"')->fetchAll(PDO::FETCH_ASSOC)[0]['user_id'];
        $this->link_id = $db->query('SELECT link_id FROM links WHERE link_url = "'.$this->link_url.'" AND user_id = '.$this->user_id)->fetchAll(PDO::FETCH_ASSOC)[0]['link_id'];
    }

    public function pages_numb()
    {
        global $items_on_page;
        global $db;
        $numb = $db->query('SELECT * FROM links')->rowCount();
        $pages = $numb/$items_on_page;
        return $pages;
    }

    public function clean()
    {
        $this->link_id = null;
        $this->link_name = null;
        $this->link_url = null;
        $this->link_description = null;
        $this->link_private_status = null;
        $this->link_born_time = null;
        $this->user_id = null;
        $this->user_login = null;
    }

    public function get_all_mine($iter, $down)
    {
        global $db;
        global $items_on_page;
        $row = $db->query("SELECT link_id, link_name, link_url, link_description, link_born_time, link_private_status,
user_id FROM links WHERE user_id = " . $_SESSION['uid'] ." LIMIT " . $down . ", " . $items_on_page)->fetchAll(PDO::FETCH_ASSOC);
        if (isset($row[$iter]))
        {
            $this->link_id = $row[$iter]["link_id"];
            $this->link_name = $row[$iter]["link_name"];
            $this->link_url = $row[$iter]["link_url"];
            $this->link_description = $row[$iter]["link_description"];
            $this->link_private_status = $row[$iter]["link_private_status"];
            $this->link_born_time = $row[$iter]["link_born_time"];
        }
    }

    public function my_pages_numb()
    {
        global $items_on_page;
        global $db;
        $numb = $db->query('SELECT * FROM links WHERE user_id = '.$_SESSION['uid'])->rowCount();
        $pages = $numb/$items_on_page;
        return $pages;
    }
}