<?php
class My_Link_Look_Controller
{
    public function my_link_look($user_id)
    {
        $link = new Link_Model();
        $link->my_link_look($user_id);
    }
}