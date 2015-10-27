<?php
class Link_Controller
{
    public function link_create($link_name, $link_url, $link_description, $link_private_status, $user_id)
    {
        $link = new Link_Model();
        if ($link->create($link_name, $link_url, $link_description, $link_private_status, date("Y-m-d H:i"), $user_id))
        {
            echo "Everithing is ok";
        }
    }

    public function link_description($link_url, $user_id)
    {
        $link = new Link_Model();
        $link->lets_see($link_url, $user_id);
    }

    public function link_edit($link_name, $link_url, $link_description, $link_private_status, $user_id)
    {
        $link = new Link_Model();
        if ($link->get_from_database($link_url, $user_id))
        {
            $link->link_name = $link_name;
            $link->link_url = $link_url;
            $link->link_description = $link_description;
            $link->link_private_status = $link_private_status;
            $link->link_born_time = date("Y-m-d H:i");
            $link->edit_link();
        }
    }

    public function link_look($private_rights)
    {
        $link = new Link_Model();
        $link->link_look($private_rights);
    }

    public function my_link_look($user_id)
    {
        $link = new Link_Model();
        $link->my_link_look($user_id);
    }
}