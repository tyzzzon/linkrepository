<?php
class Link_Controller
{
    public function link_create_action()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            echo '<script>alert("Access denied")</script>';
            $this->link_look_action(0);
        }
        else
        {
            $link = new Link_Model();
            $link->link_name = $_POST['Link_name'];
            $link->link_url = $_POST['Link_URL'];
            $link->link_description = $_POST['Link_description'];
            $link->link_private_status = $_POST['Link_private_status'];
            $link->user_id = $_SESSION['uid'];
            if ($link->link_name === "" || $link->link_url === "" || $link->link_description === "" || $link->link_private_status === "")
            {
                echo '<script>alert("Something is wrong");</script>';
                $this->link_create_view_action();
            }
            else
            {
                $link->create();
                $this->link_look_action(0);
            }
        }
    }

    public function link_create_view_action()
    {
        $content_view = new Edit_View();
        $content_view->field_ar['Link name'] = '';
        $content_view->field_ar['Link URL'] = '';
        $content_view->field_ar['Link description'] = '';
        $content_view->field_ar['Link private status'] = '';
        $content_view->action = "/link/link_create";
        $main_view = new Main_View();
        if (isset($_SESSION['uid']))
        {
            unset($main_view->header_ar['user/reg_view']);
            unset($main_view->header_ar['user/auth_view']);
        }
        $main_view->content_view = $content_view;
        $main_view->render();
    }

    public function link_description_action($link_url, $user_id)
    {
        $link = new Link_Model();
        $link->lets_see($link_url, $user_id);
    }

    public function link_look_action($private_rights = 0)
    {
            $content_view = new List_View();
            $helper_ar = array('Link name', 'URL', 'Description', 'Born time', 'User login');
            $link = new Link_Model();
            if ($private_rights) {
                array_push($helper_ar, 'Private status');
                $content_view->table_head = $helper_ar;
                for ($i = 0; $i < $link->get_number($private_rights); $i++) {
                    $link->get_all($private_rights, $i);
                    $edit_butt = new Edit_Butt_View();
                    $delete_butt = new Delete_Butt_View();
                    $edit_butt->action = "/link/edit_view/" . $link->link_id;
                    $delete_butt->id = $link->link_id;
                    $helper_ar = array($link->link_name, $link->link_url, $link->link_description, $link->link_born_time,
                        $link->user_login, $link->link_private_status);
                    array_push($content_view->edit_butt, $edit_butt);
                    array_push($content_view->delete_butt, $delete_butt);
                    array_push($content_view->table_body, $helper_ar);
                }
            } else {
                $content_view->table_head = $helper_ar;
                for ($i = 0; $i < $link->get_number($private_rights); $i++) {
                    $link->get_all($private_rights, $i);
                    $helper_ar = array($link->link_name, $link->link_url, $link->link_description, $link->link_born_time,
                        $link->user_login);
                    array_push($content_view->table_body, $helper_ar);
                }
            }
            $main_view = new Main_View();
            $content_view->delete_url = "/link/delete/";
            $main_view->content_view = $content_view;
        if (isset($_SESSION['uid']))
        {
            unset($main_view->header_ar['user/reg_view']);
            unset($main_view->header_ar['user/auth_view']);
            $main_view->header_ar['#'] = array('value' => 'Log out', 'id' => 'logout_btn');
            $main_view->header_ar['link/link_create_view'] = array('value' => 'Create link', 'id' => 'create-link');
            $main_view->header_ar['link/my_link_look'] = array('value' => 'My links', 'id' => 'my-links');
        }
            $main_view->render();
    }

    public function my_link_look_action()
    {
        $link = new Link_Model();
        $content_view = new List_View();
        $helper_ar = array('Link name', 'URL', 'Description', 'Born time', 'Private status');
        $content_view->table_head = $helper_ar;
        for ($i = 0; $i < $link->get_my_number(); $i++)
        {
            $link->my_link_look($_SESSION['uid'], $i);;
            $edit_butt = new Edit_Butt_View();
            $delete_butt = new Delete_Butt_View();
            $edit_butt->action = "/link/edit_view/" . $link->link_id;
            $delete_butt->id = $link->link_id;
            $helper_ar = array($link->link_name, $link->link_url, $link->link_description, $link->link_born_time, $link->link_private_status);
            array_push($content_view->edit_butt, $edit_butt);
            array_push($content_view->delete_butt, $delete_butt);
            array_push($content_view->table_body, $helper_ar);
        }
        $main_view = new Main_View();
        $content_view->delete_url = "/link/delete/";
        $main_view->content_view = $content_view;
        unset($main_view->header_ar['user/reg_view']);
        unset($main_view->header_ar['user/auth_view']);
        $main_view->header_ar['#'] = array('value' => 'Log out', 'id' => 'logout_btn');
        $main_view->header_ar['link/link_create_view'] = array('value' => 'Create link', 'id' => 'create-link');
        $main_view->header_ar['link/my_link_look'] = array('value' => 'My links', 'id' => 'my-links');
        $main_view->render();
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
            $content_view->action = "/link/edit";
            $main_view = new Main_View();
        if (isset($_SESSION['uid']))
        {
            unset($main_view->header_ar['user/reg_view']);
            unset($main_view->header_ar['user/auth_view']);
        }
            $main_view->content_view = $content_view;
            $main_view->render();
    }

    public function edit_action()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            echo '<script>alert("Access denied")</script>';
            $this->link_look_action(0);
        }
        else
        {
            $link = new Link_Model();
            $link->link_name = $_POST['Link_name'];
            $link->link_url = $_POST['Link_URL'];
            $link->link_description = $_POST['Link_description'];
            $link->link_private_status = $_POST['Link_private_status'];
            $link->user_login = $_POST['User_login'];
            if ($link->link_name === "" || $link->link_url === "" || $link->link_description === "" || $link->link_private_status === "" ||
                $link->user_login === "")
            {
                echo '<script>alert("Something is wrong");</script>';
                $this->edit_view_action($link->link_id);
            }
            else
            {
                $link->edit_link();
                $this->link_look_action(0);
            }
        }
    }

    public function delete_action($link_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            echo '<script>alert("Access denied")</script>';
            $this->link_look_action(0);
        }
        else
        {
            $link = new Link_Model();
            $link->delete_link($link_id);
        }
    }
}