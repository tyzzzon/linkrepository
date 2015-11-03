<?php
class Header_View
{
    public $is_signed = false;
    public $menu_ar = array();

    public function render()
    {
        echo '
                        <div class="navbar-header" >
                            <a class="navbar-brand" href = "/user/go_home" > Link repository </a >';
        foreach ($this->menu_ar as $menu_item => $menu_dislocation)
        {
            echo '
                            <a class="navbar-brand" href = "/'.$menu_dislocation.'" > '.$menu_item.'</a >';
        }
        echo '
                        </div>';
        if ($this->is_signed)
        {
        }
        else
            echo '
                        <div id = "navbar" class="navbar-collapse collapse" >
                            <form class="navbar-form navbar-right" action = "/user/authentification" method = "post" >
                                <div class="form-group" >
                                    <input type = "text" name = "Login" placeholder = "Login" class="form-control" >
                                </div >
                                <div class="form-group" >
                                    <input type = "password" name = "Password" placeholder = "Password" class="form-control" >
                                </div >
                                <button type = "submit" name = "ok" class="btn btn-success" > Sign in </button >
                            </form >
                        </div >';
    }
}
?>