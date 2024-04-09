<?php
require '../vendor/autoload.php';
use App\Controller\HomeController;
use App\Controller\NewsletterRegistrationController;
use App\Controller\ErrorController;
use App\Controller\DashboardController;
use App\Controller\SendNewsletterController;

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
    case "/sendNewsletter";
        $controller = new SendNewsletterController();
        $controller->displaySendForm();
        break;
    default:
        $controller = new ErrorController();
        $controller->display404();
}