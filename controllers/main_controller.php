<?php
class Main_Controller
{
    public function index_action()
    {
        $user_con = new User_Controller();
            if ($_SERVER["REQUEST_URI"] == "/")
            {
                $user_con->go_home_action();
            }
    }
}