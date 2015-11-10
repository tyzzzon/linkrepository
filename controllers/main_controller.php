<?php
class Main_Controller
{
    public function index_action()
    {
            $main_view = new Main_View();
            $content_view = new Home_View();
            if ($_SERVER["REQUEST_URI"] == "/") {
                $main_view->content_view = $content_view;
                $main_view->render();
            }
            /*else
            {
                $main_view->render($_SERVER["REQUEST_URI"]);
            }*/
    }
}