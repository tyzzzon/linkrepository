<?php
class Link_Controller
{
    public function link_create_action($link_name, $link_url, $link_description, $link_private_status, $user_id)
    {
        $link = new Link_Model();
        if ($link->create($link_name, $link_url, $link_description, $link_private_status, date("Y-m-d H:i"), $user_id))
        {
            echo '<script>alert("Everithing is ok");</script>';
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
        $content_view = new List_View();
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
                array_push($helper_ar, '<a class="btn btn-primary btn-lg" href = "/link/edit_view/'.$link->link_id.'" role = "button" > Edit </a >');
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
        {
            unset($main_view->header_ar['Registration']);
            unset($main_view->header_ar['Authentication']);
        }
        $main_view->render();
    }

    public function my_link_look_action($user_id)
    {
        $link = new Link_Model();
        $link->my_link_look($user_id);
    }

    public function edit_view_action($link_id)
    {
        $link = new Link_Model();
        $link->get_from_database($link_id);
        $content_view = new Edit_View();
        $content_view->field_ar['Link name'] = $link->link_name;
        $content_view->field_ar['Link URL'] = $link->link_url;
        $content_view->field_ar['Link description'] = $link->link_description;
        $content_view->field_ar['Link private status'] = $link->link_private_status;
        $content_view->field_ar['User login'] = $link->user_login;
        $main_view = new Main_View();
        $main_view->content_view = $content_view;
        $main_view->render();
    }

    public function edit_action()
    {
        $link = new Link_Model();
        $link->link_name = $_POST['Link name'];
        $link->link_url = $_POST['Link URL'];
        $link->link_description = $_POST['Link description'];
        $link->link_private_status = $_POST['Link private status'];
        $link->user_login = $_POST['User login'];
        if ($link->link_name === "" || $link->link_url === "" || $link->link_description === "" || $link->link_private_status === "" ||
            $link->user_login === "")
        {
            echo '<script>alert("Somthing is wrong");</script>';
            $this->edit_view_action($link->link_url, $link->user_login);
        }
        else
        {
            $link->edit_link();
        }
    }
}