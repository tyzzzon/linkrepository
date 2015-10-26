<?php
class Link_Look_Controller
{
    public function link_look($private_rights)
    {
        $link = new Link_Model();
        $link->link_look($private_rights);
    }
}