<?php
class Link_Create_Controller
{
    public function link_create($link_name, $link_url, $link_description, $link_private_status, $user_id)
    {
        $link = new Link_Model();
        if ($link->create($link_name, $link_url, $link_description, $link_private_status, date("Y-m-d H:i"), $user_id))
        {
            echo "Everithing is ok";
        }
    }
}