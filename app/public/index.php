<?php
require '../vendor/autoload.php';
use App\Controller\NewsletterRegistrationController;
use App\Controller\ErrorController;

session_start();

switch($_SERVER["REQUEST_URI"]) {
    case "/";
        echo("Hello World");
        break;
    case "/registration";
        $controller = new NewsletterRegistrationController();
        $controller->displayForm();
        break;
    default:
        $controller = new ErrorController();
        $controller->display404();
}