<?php
class Link_Description_Controller
{
    public function link_description($link_url, $user_id)
    {
        $link = new Link_Model();
        $link->lets_see($link_url, $user_id);
    }
}