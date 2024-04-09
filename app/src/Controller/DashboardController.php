<?php
namespace App\Controller;
use App\BaseController;

class DashboardController extends BaseController {
    public function displayDashboard() {
        $curlNewsletters = $this->curlGetEveryNewsletter();
        $newslettersPending = $this->getEveryPendingNewsletter($curlNewsletters);
        $this->render("dashboard.view", ["newslettersPending" => $newslettersPending]);
    }
}