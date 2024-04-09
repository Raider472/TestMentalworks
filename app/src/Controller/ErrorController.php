<?php
namespace App\Controller;
use App\BaseController;

class ErrorController extends BaseController {

    function display404() {
        $this->render("error404.view");
    }
}