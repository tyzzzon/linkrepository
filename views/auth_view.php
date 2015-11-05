<?php
class Auth_View
{
    public function render()
    {
        echo '
                            <form class="navbar-form" action = "/user/authentication" method = "post" >
                                <div class="form-group" >
                                    <input type = "text" name = "Login" placeholder = "Login" class="form-control" >
                                </div >
                                <div class="form-group" >
                                    <input type = "password" name = "Password" placeholder = "Password" class="form-control" >
                                </div >
                                <button type = "submit" name = "ok" class="btn btn-success" > Sign in </button >
                            </form >';
    }
}