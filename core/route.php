<?php
class Route
{
    function ErrorPage404()
    {
        //$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not found');
        header("Status: 404 Not found");
        header('Location: /views/404.php');
    }

    static function start()
    {
        //controller and default action
        $controller_name = 'Main';
        $action_name = 'index';
        $view_name = 'Main';

        $routes = ($strpos=strpos($_SERVER['REQUEST_URI'],"?"))!==false?substr($_SERVER['REQUEST_URI'],0,$strpos):$_SERVER['REQUEST_URI'];
        //var_dump($routes);
        $routes = explode('/', $routes);
        //var_dump($routes);
        //getting the name of the controller
        if ( !empty($routes[1]))
        {
            $controller_name = $routes[1];
        }

        //getting the name of the action
        if ( !empty($routes[2]))
        {
            $action_name = $routes[2];
        }
        //adding postfixes
        $model_name = $controller_name.'_Model';
        $controller_name = $controller_name.'_Controller';
        $action_name = $action_name.'_action';

        //file of model-class
        $model_file = strtolower($model_name).'.php';
        $model_path = "models/".$model_file;
        if(file_exists($model_path))
        {
            //file of controller-class
            $controller_file = strtolower($controller_name).'.php';
            $controller_path = "controllers/".$controller_file;
            if(file_exists($controller_path))
            {
                //making a controller
                $controller = new $controller_name;
                //var_dump($action_name);
//              var_dump($controller);
                if (method_exists($controller, $action_name)) {
                    //calling an action of controller
                    $controller->$action_name();
                }
                else
                {
                    Route::ErrorPage404();
                }
            }
            else
            {
                Route::ErrorPage404();
            }
        }
        else
        {
            if ( !empty($routes[1]))
            {
                $view_name = $routes[1];
            }
            $view_name = $view_name."_view";
            if (file_exists("views/".$view_name.".php"))
            {
                include "views/".$view_name.".php";
            }
            else
            {
                Route::ErrorPage404();
            }
        }
    }
}