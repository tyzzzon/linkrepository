<?php
function autoloadModel($className) {
    $filename = "models/" . strtolower($className) . ".php";
    if (is_readable($filename)) {
        require $filename;
    }
}

function autoloadController($className) {
    $filename = "controllers/" . strtolower($className) . ".php";
    if (is_readable($filename)) {
        require $filename;
    }
}

spl_autoload_register("autoloadModel");
spl_autoload_register("autoloadController");