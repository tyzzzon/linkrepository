<?php
class View
{
    function render($view, $data = null)
    {
        include 'views/'.$view."php";
    }
}