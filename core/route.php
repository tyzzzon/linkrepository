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
        echo "6";

        $routes = ($strpos=mb_strpos($_SERVER['REQUEST_URI'],"?"))!==false?mb_substr($_SERVER['REQUEST_URI'],0,$strpos):$_SERVER['REQUEST_URI'];
        //var_dump($routes);
        $routes = explode('/', $routes);
        //var_dump($routes);
        //getting the name of the controller
        if ( !empty($routes[1]))
        {
            $controller_name = $routes[1];
        }
        echo "1";

        //getting the name of the action
        if ( !empty($routes[2]))
        {
            $action_name = $routes[2];
        }
        //adding prefixes
        //$model_name = $controller_name.'_Model';
        $controller_name = $controller_name.'_Controller';
        $action_name = $action_name.'_action';
        echo "2";

        //file of model-class
        //$model_file = strtolower($model_name).'.php';
        //$model_path = "models/".$model_file;
        /*if(file_exists($model_path))
        {
            include "models/".$model_file;
        }*/
        echo "3";

        //file of controller-class
        //$controller_file = strtolower($controller_name).'.php';
        /*$controller_path = "controllers/".$controller_file;
        if(file_exists($controller_path))
        {
            include "controllers/".$controller_file;
        }
        else
        {
            Route::ErrorPage404();
        }*/
        //making a controller
        echo "4";
        //exit();
          $controller = new $controller_name;
        //var_dump($action_name);
        //$action = new $action_name;
        echo "5";
        //exit();
//        var_dump($controller);
//        var_dump($action_name);
        if (method_exists($controller, $action_name))
        {
            echo "7";
            //exit();
            //calling an action of controller
            $controller->$action_name();
            echo "9";
        }
        else
        {
            echo "8";
            //exit();
            Route::ErrorPage404();
        }


    }
}