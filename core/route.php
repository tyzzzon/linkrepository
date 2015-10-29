<?php
class Route
{
    function ErrorPage404()
    {
        header('HTTP/1.1 404 Not found');
        header("Status: 404 Not found");
        header('Location: /views/404.php');
    }

    static function start()
    {
        //controller and default action
        $controller_name = 'Main';
        $action_name = 'index';

        $routes = ($strpos=strpos($_SERVER['REQUEST_URI'],"?"))!==false?substr($_SERVER['REQUEST_URI'],0,$strpos):$_SERVER['REQUEST_URI'];
        $routes = explode('/', $routes);

        //getting the name of the controller
        //getting the name of the action
        if ( !empty($routes[1]) && !empty($routes[2]))
        {
            $controller_name = $routes[1];
            $action_name = $routes[2];
        }

        //adding postfixes
        $controller_name = $controller_name.'_Controller';
        $action_name = $action_name.'_action';


            //file of controller-class
            //$controller_file = strtolower($controller_name).'.php';
            //$controller_path = "controllers/".$controller_file;

            if(class_exists($controller_name))
            {
                echo "Yeah!";
                //making a controller
                $controller = new $controller_name;
                if (method_exists($controller, $action_name))
                {
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
}