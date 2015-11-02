<?php
class Main_Controller
{
    public function index_action()
    {
        $view = new Main_View();
        $view->ar['is_signed'] = true;
        if ($_SERVER["REQUEST_URI"]=="")
            $view->render($_SERVER["REQUEST_URI"]);
        else
            $view->render("index");
    }
}