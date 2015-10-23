<?php
class Route
{
    function ErrorPage404()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not found');
        header("Status: 404 Not found");
        header('Location: '.$host.'404');
    }

    static function start()
    {
        //controller and default action
        $controller_name = 'Main';
        $action_name = 'index';

        $routes = explode('/', $_SERVER['REQUEST_URI']);
        //getting the name of the controller
        if ( !empty($routes[1]))
        {
            $controller_name = $routes[1];
        }

        //getting the name of the controller
        if ( !empty($routes[2]))
        {
            $action_name = $routes[2];
        }
        //adding prefixes
        $model_name = $controller_name.'_Model';
        $controller_name = $controller_name.'_Controller';
        $action_name = $action_name.'_Action';

        //file of model-class
        $model_file = strtolower($model_name).'.php';
        $model_path = "models/".$model_file;
        if(file_exists($model_path))
        {
            include "models/".$model_file;
        }

        //file of controller-class
        $controller_file = strtolower($controller_name).'.php';
        $controller_path = "controllers/".$controller_file;
        if(file_exists($controller_path))
        {
            include "controllers/".$controller_file;
        }
        else
        {
            Route::ErrorPage404();
        }
        echo "4";
        //making a controller

          $controller = new $controller_name;
//        var_dump($action_name);
//        $action = new $action_name;
        echo "5";

        if (method_exists($controller, $action_name))
        {
            //calling an action of controller
            $controller->$action_name;
            echo "7";
        }
        else
        {
            Route::ErrorPage404();
        }
        echo "6";


    }
}