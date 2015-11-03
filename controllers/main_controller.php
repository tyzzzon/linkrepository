<?php
class Main_Controller
{
    public function index_action()
    {
        $view = new Main_View();

        if ($_SERVER["REQUEST_URI"]=="/")
        {
            $view->render("home");
        }
        else
        {
            $view->render($_SERVER["REQUEST_URI"]);
        }
    }
}