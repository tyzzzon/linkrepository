<?php
class View
{
    function render($view)
    {
        include 'views/'.$view.".php";
    }
}