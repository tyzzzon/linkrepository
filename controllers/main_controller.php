<?php
class Main_Controller
{
    public function index_action()
    {
        $view = new View();
        $view->render(str_replace("/", "", $_SERVER["REQUEST_URI"]));
    }
}