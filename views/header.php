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
            <a class="navbar-brand" href="/registration">Registration</a>
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