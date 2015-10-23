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
        $numb = $db->query("SELECT `link_name` ,  `link_url` ,  `link_description` ,  `link_private_status` ,
`link_born_time` , `user_id` FROM `links` WHERE `link_url` = '".$link_url."' AND user_id =
".$user_id)->rowCount();
        if ($numb)
        {
            echo "There is a link with such url<br>";
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
        }
    }

    public function get_from_database($link_url, $user_id)
    {
        $db = new PDO('mysql:host=linkrepository;dbname=linkrepository','root','111111');
        $numb = $db->query("SELECT `link_name` ,  `link_url` ,  `link_description` ,  `link_private_status` ,
`link_born_time` , `user_id` FROM `links` WHERE `link_url` = '".$link_url."' AND user_id =
".$user_id)->rowCount();
        switch ($numb)
        {
            case 1:
                $row = $db->query("SELECT `link_id`, `link_name` ,  `link_url` ,  `link_description` ,  `link_private_status` ,
`link_born_time` , `user_id` FROM `links` WHERE `link_url` = '".$link_url."' AND user_id =
".$user_id)->fetchAll(PDO::FETCH_ASSOC);
                $this->link_id = $row[0]["link_id"];
                $this->link_name = $row[0]["link_name"];
                $this->link_url = $row[0]["link_url"];
                $this->link_description = $row[0]["link_description"];
                $this->link_private_status = $row[0]["link_private_status"];
                $this->link_born_time = $row[0]["link_born_time"];
                $this->user_id = $row[0]["user_id"];
                echo "Everything is ok<br>";
                break;
            case 0:
                echo "There is no such link<br>";
                break;
            default:
                echo "Smth is wrong...<br>";
                break;
        }
    }

    public function delete_link($link_url, $user_id)
    {
        $db = new PDO('mysql:host=linkrepository;dbname=linkrepository','root','111111');
        $numb = $db->query("SELECT `link_name` ,  `link_url` ,  `link_description` ,  `link_private_status` ,
`link_born_time` , `user_id` FROM `links` WHERE `link_url` = '".$link_url."' AND user_id =
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

    /*public function edit_link($link_name, $link_url, $link_description, $link_private_status, $user_id)
    {
        $db = new PDO('mysql:host=linkrepository;dbname=linkrepository','root','111111');
        $numb = $db->query("SELECT link_name, link_url, link_description, link_private_status FROM `links`
WHERE `link_url` = '".$link_url."'AND user_id =".$user_id)->rowCount();
        if ($numb)
        {
            $db->query("UPDATE users SET link_name = '".$link_name."', link_url =
             '".$link_url."', link_description = '".$link_description."', link_private_status =
              '".$link_private_status."' WHERE `link_url` = '".$link_url."'AND user_id =".$user_id);
        }
        else
        {
            echo "There is no such link<br>";
        }
    }*/
}