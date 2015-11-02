<?php
function autoloadModel($className) {
    $filename = "models/" . strtolower($className) . ".php";
    if (is_readable($filename)) {
        require_once $filename;
    }
}

function autoloadController($className) {
    $filename = "controllers/" . strtolower($className) . ".php";
    if (is_readable($filename)) {
        require_once $filename;
    }
}

function autoloadCore($className) {
    $filename = "core/" . strtolower($className) . ".php";
    if (is_readable($filename)) {
        require_once $filename;
    }
}

function autoloadConfig($className) {
    $filename = "config/" . strtolower($className) . ".php";
    if (is_readable($filename)) {
        require_once $filename;
    }
}

function autoloadView($className) {
    $filename = "views/" . strtolower($className) . ".php";
    if (is_readable($filename)) {
        require_once $filename;
    }
}

spl_autoload_register("autoloadModel");
spl_autoload_register("autoloadController");
spl_autoload_register("autoloadCore");
spl_autoload_register("autoloadConfig");
spl_autoload_register("autoloadView");