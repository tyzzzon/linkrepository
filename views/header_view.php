<?php
class Header_View
{
    public $is_signed = false;

    public function render()
    {
        echo '
                <nav class="navbar navbar-inverse navbar-fixed-top" >
                    <div class="container" >
                        <div class="navbar-header" >
                            <button type = "button" class="navbar-toggle collapsed" data-toggle = "collapse" data-target = "#navbar" aria-expanded = "false" aria-controls = "navbar" >
                                <span class="sr-only" > Toggle navigation </span >
                                <span class="icon-bar" ></span >
                                <span class="icon-bar" ></span >
                                <span class="icon-bar" ></span >
                            </button >
                            <a class="navbar-brand" href = "/index" > Link repository </a >
                            <a class="navbar-brand" href = "/index" > Home</a >
                            <a class="navbar-brand" href = "/links" > Links</a >';
        if ($this->is_signed)
        {
            $this->is_signed=false;
            echo '<a class="navbar-brand" href = "/index" >Log out</a >';
        }
        else
            echo '
                            <a class="navbar-brand" href = "/registration" > Registration</a >
                        </div >
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
        echo '
                    </div >
                </nav >';
    }
}
?>