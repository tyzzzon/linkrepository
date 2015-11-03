<?php
class Link_Controller
{
    public function link_create_action($link_name, $link_url, $link_description, $link_private_status, $user_id)
    {
        $link = new Link_Model();
        if ($link->create($link_name, $link_url, $link_description, $link_private_status, date("Y-m-d H:i"), $user_id))
        {
            echo "Everithing is ok";
        }
    }

    public function link_description_action($link_url, $user_id)
    {
        $link = new Link_Model();
        $link->lets_see($link_url, $user_id);
    }

    public function link_edit_action($link_name, $link_url, $link_description, $link_private_status, $user_id)
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

    public function link_look_action($private_rights, $is_signed = false)
    {
        $content_view = new Links_View();
        $helper_ar = array('Link name', 'URL', 'Description', 'Born time', 'User login');
        $link = new Link_Model();
        if ($private_rights)
        {
            array_push($helper_ar, 'Private status');
            $content_view->table_head = $helper_ar;
            for ($i = 0; $i < $link->get_number($private_rights); $i++)
            {
                $link->get_all($private_rights, $i);
                $helper_ar = array($link->link_name, $link->link_url, $link->link_description, $link->link_born_time,
                    $link->user_login, $link->link_private_status);
                array_push($content_view->table_body, $helper_ar);
            }
        }
        else
        {
            $content_view->table_head = $helper_ar;
            for ($i = 0; $i < $link->get_number($private_rights); $i++)
            {
                $link->get_all($private_rights, $i);
                $helper_ar = array($link->link_name, $link->link_url, $link->link_description, $link->link_born_time,
                    $link->user_login);
                array_push($content_view->table_body, $helper_ar);
            }
        }
        $main_view = new Main_View();
        $main_view->content_view = $content_view;
        if ($is_signed)
            unset($main_view->header_ar['Registration']);
        $main_view->render();
    }

    public function my_link_look_action($user_id)
    {
        $link = new Link_Model();
        $link->my_link_look($user_id);
    }
}