<?php
class Route
{
    public static function ErrorPage404()
    {
        header('HTTP/1.1 404 Not found');
        header("Status: 404 Not found");
        User_Controller::error404_action();
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
        if ( !empty($routes[1]))
        {
            $controller_name = $routes[1];
        }

        if (!empty($routes[2]))
            $action_name = $routes[2];

        if (!empty($routes[3]))
        {
            $parameter = $routes[3];
        }

        //adding postfixes
        $controller_name = $controller_name.'_Controller';
        $action_name = $action_name.'_action';

            //file of controller-class
            //$controller_file = strtolower($controller_name).'.php';
            //$controller_path = "controllers/".$controller_file;
            if(class_exists($controller_name))
            {
                //making a controller
                $controller = new $controller_name;
                if (method_exists($controller, $action_name))
                {
                    //calling an action of controller
                    if (isset($parameter))
                    {
                        $controller->$action_name($parameter);
                    }
                    else
                    {
                        $controller->$action_name();
                    }
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