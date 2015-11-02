<?php
class Temp_Link_View
{
    public function render($is_good)
    {
        if ($is_good)
        {
            echo '
        <div class="container" >
            <h2 > Good news, everyone!</h2 >
            <p> You can to sign in now!</p >
            <p ><a class="btn btn-primary btn-lg" href = "/login" role = "button" > Learn more » </a ></p >
        </div >';
        }
        else
        {
            echo '
        <div class="container" >
            <h2 > Good news, everyone!</h2 >
            <p> Something wrong with your temporary link(maybe time is out).</p >
            <form class="navbar-form navbar-right" action = "/user/authentification" method = "post" >
                Send new one?
                <button type = "submit" name = "ok" class="btn btn-success" > Of course! </button >
            </form >
        </div >';
        }
    }
}
?>