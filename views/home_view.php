<?php
class Home_View
{
    public function render()
    {
        echo '
    <div class="jumbotron" >
        <div class="container" >
            <h1 > Welcome!</h1 >
            <p> A lot of usefull information about my application .</p >
            <p ><a class="btn btn-primary btn-lg" href = "#" role = "button" > Learn more » </a ></p >
        </div >
    </div >
    <div class="container" >
        <div class="row" >
            <div class="col-md-4" >
                <h2 > Heading</h2 >
                <p > Donec id elit non mi porta gravida at eget metus . Fusce dapibus, tellus ac cursus commodo, tortor
                    mauris condimentum nibh, ut fermentum massa justo sit amet risus . Etiam porta sem malesuada magna
                    mollis euismod . Donec sed odio dui . </p >
                <p ><a class="btn btn-default" href = "#" role = "button" > View details » </a ></p >
            </div >
            <div class="col-md-4" >
                <h2 > Heading</h2 >
                <p > Donec id elit non mi porta gravida at eget metus . Fusce dapibus, tellus ac cursus commodo, tortor mauris
                    condimentum nibh, ut fermentum massa justo sit amet risus . Etiam porta sem malesuada magna mollis
                    euismod . Donec sed odio dui . </p >
                <p ><a class="btn btn-default" href = "#" role = "button" > View details » </a ></p >
            </div >
            <div class="col-md-4" >
                <h2 > Heading</h2 >
                <p > Donec sed odio dui . Cras justo odio, dapibus ac facilisis in, egestas eget quam . Vestibulum id
                    ligula porta felis euismod semper . Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum
                    nibh, ut fermentum massa justo sit amet risus .</p >
                <p ><a class="btn btn-default" href = "#" role = "button" > View details » </a ></p >
            </div >
        </div >
    </div>
    <hr >';
    }
}
?>
