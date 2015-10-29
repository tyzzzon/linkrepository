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

    function __construct()
    {
        parent::__construct();
    }

    public function create($link_name, $link_url, $link_description, $link_private_status,
                           $link_born_time, $user_id)
    {
        $db = new PDO('mysql:host=linkrepository;dbname=linkrepository', 'root', '111111');
        $numb = $db->query("SELECT `link_name` FROM `links` WHERE `link_url` = '".$link_url."' AND user_id =
".$user_id)->rowCount();
        if ($numb)
        {
            echo "There is a link with such url<br>";
            return false;
        }
        else
        {
            echo "Everything is ok <br>";
            $this->link_name = $link_name;
            $this->link_url = $link_url;
            $this->link_description = $link_description;
            $this->link_private_status = $link_private_status;
            $this->link_born_time = $link_born_time;
            $this->user_id = $user_id;
            $db->query("INSERT INTO links (`link_name` ,  `link_url` ,  `link_description` ,  `link_private_status` ,
`link_born_time` , `user_id`) VALUES ('" . $link_name . "', '" . $link_url . "', '" .
                $link_description . "', '" . $link_private_status . "', '" . $link_born_time . "', '" . $user_id . "')");
            $get_id = $db->query("SELECT `link_id` FROM `links` WHERE `link_url` = '" . $link_url . "' AND
        `user_id` = '" . $user_id . "'")->fetchAll(PDO::FETCH_ASSOC);
            $this->link_id = $get_id[0]["link_id"];
            return true;
        }
    }

    public function get_from_database($link_url, $user_id)
    {
        $db = new PDO('mysql:host=linkrepository;dbname=linkrepository','root','111111');
        $numb = $db->query("SELECT `link_name` FROM `links` WHERE `link_url` = '".$link_url."' AND user_id =
".$user_id)->rowCount();
        if ($numb)
        {
            $row = $db->query("SELECT `link_id`, `link_name` ,  `link_url` ,  `link_description` ,  `link_private_status` ,
`link_born_time` , `user_id` FROM `links` WHERE `link_url` = '" . $link_url . "' AND user_id =
" . $user_id)->fetchAll(PDO::FETCH_ASSOC);
            $this->link_id = $row[0]["link_id"];
            $this->link_name = $row[0]["link_name"];
            $this->link_url = $row[0]["link_url"];
            $this->link_description = $row[0]["link_description"];
            $this->link_private_status = $row[0]["link_private_status"];
            $this->link_born_time = $row[0]["link_born_time"];
            $this->user_id = $row[0]["user_id"];
            echo "Everything is ok<br>";
            return true;
        }
        else
        {
            echo "There is no such link<br>";
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

    public function delete_link($link_url, $user_id)
    {
        $db = new PDO('mysql:host=linkrepository;dbname=linkrepository','root','111111');
        $numb = $db->query("SELECT `link_name` FROM `links` WHERE `link_url` = '".$link_url."' AND user_id =
".$user_id)->rowCount();
        switch ($numb)
        {
            case 1:
                $db->query("DELETE FROM links WHERE `link_url` = '".$link_url."' AND user_id =
".$user_id);
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
    //могут быть одинаковые ссылки у разных пользователей
    public function edit_link()
    {
        $db = new PDO('mysql:host=linkrepository;dbname=linkrepository','root','111111');
        $numb = $db->query("SELECT link_name FROM `links` WHERE `link_url` = '".$this->link_url."'AND user_id =".$this->user_id)->rowCount();
        if ($numb)
        {
            $db->query("UPDATE links SET link_name = '".$this->link_name."', link_url =
             '".$this->link_url."', link_description = '".$this->link_description."', link_private_status =
              ".$this->link_private_status." WHERE `link_url` = '".$this->link_url."'AND user_id =".$this->user_id);
            echo "Everithing is ok";
        }
        else
        {
            echo "There is no such link<br>";
        }
    }

    public function link_look($private_rights)
    {
        $db = new PDO('mysql:host=linkrepository;dbname=linkrepository','root','111111');
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

    public function my_link_look($user_id)
    {
        $db = new PDO('mysql:host=linkrepository;dbname=linkrepository','root','111111');
        $rows = $db->query("SELECT DISTINCT link_name, link_url, link_description, link_private_status FROM
links WHERE user_id = " . $user_id)->fetchAll(PDO::FETCH_ASSOC);
        for ($i = 0; $i < count($rows); $i++)
        {
            echo "Link name = ".$rows[$i]["link_name"]." link url = ".$rows[$i]["link_url"]." link description = ".
                $rows[$i]["link_description"]." link private status = ".$rows[$i]["link_private_status"]."<br>";
        }
    }
}