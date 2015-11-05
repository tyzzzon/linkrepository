<?php
class Registration_View
{
    public function render()
    {
        echo '
        <div class = "jumbotron" >
            <div class = "container" >
                <h1 > Registration!</h1 >
                <p ><form class = "navbar-form navbar-left" action = "/user/registration" method = "post" >
                <div class = "form-group" >
                    Your name: <input type = "text" name = "user_name" placeholder = "Name" class = "form-control" >
                </div >
                <br >
                <div class = "form-group" >
                    Your surname: <input type = "text" name = "user_surname" placeholder = "Surname" class = "form-control" >
                </div >
                <br >
                <div class = "form-group" >
                    Your login *: <input type = "text" name = "user_login" placeholder = "Login" class = "form-control" >
                </div >
                <br >
                <div class = "form-group" >
                    Your email *: <input type = "text" name = "user_email" placeholder = "E-mail" class = "form-control" >
                </div >
                <br >
                <div class = "form-group" >
                    Your password *: <input type = "password" name = "user_password" placeholder = "Password" class = "form-control" >
                </div >
                <br >
                <div class = "form-group" >
                    Confirm password *: <input type = "password" name = "user_password_confirm" placeholder = "Confirm password" class = "form-control" >
                </div >
                <br >
                <button type = "submit" name = "ok" class = "btn btn-success" > Log in </button >
                </form ></p >
            </div >
        </div >
        <hr>';
    }
}
?>