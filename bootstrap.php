<?php
require_once 'core/model.php';
require_once 'core/view.php';
require_once 'core/controller.php';
require_once 'core/route.php';

session_start();
$db = new PDO('mysql:host=linkrepository;dbname=linkrepository','root','111111');
$route = new Route();
$route->start();
