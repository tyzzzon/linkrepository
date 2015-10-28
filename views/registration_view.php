<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Main page</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">body{padding-top:50px;padding-bottom:40px;}</style>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Link repository</a>
            <a class="navbar-brand" href="#">Home</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <form class="navbar-form navbar-right" action="/user/authentification" method="post">
                <div class="form-group">
                    <input type="text" name="Login" placeholder="Login" class="form-control">
                </div>
                <div class="form-group">
                    <input type="password" name="Password" placeholder="Password" class="form-control">
                </div>
                <button type="submit" name="ok" class="btn btn-success">Sign in</button>
            </form>
        </div><!--/.navbar-collapse -->
    </div>
</nav>
<div class="jumbotron">
    <div class="container">
        <h1>Registration!</h1>
        <p><form class="navbar-form navbar-left" action="/user/registration" method="post">
            <div class="form-group">
                Your name: <input type="text" name="user_name" placeholder="Name" class="form-control">
            </div>
            <br>
            <div class="form-group">
                Your surname: <input type="text" name="user_surname" placeholder="Surname" class="form-control">
            </div>
            <br>
            <div class="form-group">
                Your login*: <input type="text" name="user_login" placeholder="Login" class="form-control">
            </div>
            <br>
            <div class="form-group">
                Your email*: <input type="text" name="user_email" placeholder="E-mail" class="form-control">
            </div>
            <br>
            <div class="form-group">
                Your password*: <input type="password" name="user_password" placeholder="Password" class="form-control">
            </div>
            <br>
            <div class="form-group">
                Confirm password*: <input type="password" name="user_password_confirm" placeholder="Confirm password" class="form-control">
            </div>
            <br>
            <button type="submit" name="ok" class="btn btn-success">Log in</button>
        </form></p>
    </div>
</div>
<div class="container">
    <!-- Example row of columns -->
    <div class="row">
        <div class="col-md-4">
            <h2>Heading</h2>
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor
                mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna
                mollis euismod. Donec sed odio dui. </p>
            <p><a class="btn btn-default" href="#" role="button">View details »</a></p>
        </div>
        <div class="col-md-4">
            <h2>Heading</h2>
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris
                condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis
                euismod. Donec sed odio dui. </p>
            <p><a class="btn btn-default" href="#" role="button">View details »</a></p>
        </div>
        <div class="col-md-4">
            <h2>Heading</h2>
            <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id
                ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum
                nibh, ut fermentum massa justo sit amet risus.</p>
            <p><a class="btn btn-default" href="#" role="button">View details »</a></p>
        </div>
    </div>

    <hr>

    <footer>
        <p>© Company 2015</p>
    </footer>
</div>
<script src="/js/bootstrap.min.js"></script>
</body>
</html>