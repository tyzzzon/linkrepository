<?php
class Link_Edit
{
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
}