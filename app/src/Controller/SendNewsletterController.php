<?php
namespace App\Controller;
use App\BaseController;
use App\VerificationController;

class SendNewsletterController extends BaseController {
    public function displaySendForm() {
        $values = ["select_newsletter" => (isset($_POST['select_newsletter'])?$_POST['select_newsletter']:"")];

        if(isset($_POST['submit']) && $values["select_newsletter"] != "") {
            $newsletterToSend = $this->curlGetNewsletterById($values["select_newsletter"]);
            $controllerVerification = new VerificationController();

            if(!($controllerVerification->isItNull($newsletterToSend))) {
                $newsletterToSend = $this->getEveryPendingNewsletter($newsletterToSend);
                for($i = 0; $i < count($newsletterToSend[0]->subscribedUsers); $i++) {
                    mail($newsletterToSend[0]->subscribedUsers[$i]->email, $newsletterToSend[0]->title, $newsletterToSend[0]->content, "Content-Type: text/html; charset=UTF-8\r\n");
                }
                $this->curlUpdateNewsletterStatus($newsletterToSend[0]);
                header("Location: /");
            }
        }

        $curlNewsletters = $this->curlGetEveryNewsletter();
        $newslettersPending = $this->getEveryPendingNewsletter($curlNewsletters);
        $this->render("sendNewsletter.view", ["newsletters" => $newslettersPending]);
    }
}