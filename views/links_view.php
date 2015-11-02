<?php
class Links_View
{
    public function render($private_status=false)
    {
        $links = new Link_Controller();
        $links->link_look($private_status);
    }
}
?>
