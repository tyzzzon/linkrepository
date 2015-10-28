<?php
class View
{
    function render($view_name)
    {
        if ($view_name == "")
        {
            $view_name = "index";
        }
            include 'views/' . $view_name . "_view.php";
    }
}