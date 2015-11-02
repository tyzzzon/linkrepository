<?php
class Main_Controller
{
    public function index_action()
    {
        $view = new Main_View();
        $view->render($_SERVER["REQUEST_URI"]);
    }
}