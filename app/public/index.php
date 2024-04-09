<?php
require '../vendor/autoload.php';
use App\Controller\HomeController;
use App\Controller\NewsletterRegistrationController;
use App\Controller\ErrorController;
use App\Controller\DashboardController;

session_start();

switch($_SERVER["REQUEST_URI"]) {
    case "/";
        $controller = new HomeController();
        $controller->dispalyHome();
        break;
    case "/registration";
        $controller = new NewsletterRegistrationController();
        $controller->displayForm();
        break;
    case "/dashboard";
        $controller = new DashboardController();
        $controller->displayDashboard();
        break;
    default:
        $controller = new ErrorController();
        $controller->display404();
}