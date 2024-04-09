<?php
namespace App\Controller;
use App\BaseController;

class HomeController extends BaseController {
    public function dispalyHome() {
        $this->render("home.view");
    }
}