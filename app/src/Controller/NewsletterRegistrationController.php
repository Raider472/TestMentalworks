<?php
namespace App\Controller;
use App\BaseController;
use App\Model\User;
use App\VerificationController;

class NewsletterRegistrationController extends BaseController {
    //used to display errors during the completion of the form
    private array $errors = ["textInput" => "", "interestsCheckbox" => "", "policyCheckbox" => ""];

    function displayForm() {
        //set the values array, if the user submited his request it will store the data, otherwise it will be blank
        $values = [
            "input_firstName" => (isset($_POST['input_firstName'])?$_POST['input_firstName']:""),
            "input_lastName" => (isset($_POST['input_lastName'])?$_POST['input_lastName']:""),
            "input_email" => (isset($_POST['input_email'])?$_POST['input_email']:""),
            "input_profession" => (isset($_POST['input_profession'])?$_POST['input_profession']:""),
            "checkbox_interests" => (isset($_POST['checkbox_interests'])?$_POST['checkbox_interests']:null),
            "checkbox_policy" => (isset($_POST['checkbox_policy'])?$_POST['checkbox_policy']:null)
        ];

        //check if the user clicked on the submit button
        if(isset($_POST['submit'])) {
            $controllerVerification = new VerificationController();
            $resultVerification = $controllerVerification->verificationRegister($values);

            if($resultVerification["result"]) {
                $this->prepareCurlPost($values);
            }
            else {
                $this->errors = $resultVerification["errors"];
            }
        }

        $this->render("newsletterRegistration.view", ["values" => $values, "errors" => $this->errors]);
    }

    //functions to prepare a curl request
    private function prepareCurlPost(array $values) {
        $interests = [];
        foreach($values["checkbox_interests"] as $interest) {
            $interests[] = $interest;
        }

        $newUser = new User(
            $this->curlIncrementIdRegister(),
            $values["input_firstName"],
            $values["input_lastName"],
            $values["input_email"],
            $values["input_profession"],
            $interests,
            true,
            date('Y-m-d H:i:s')
        );

        $this->curlSendRegistration($newUser);
        //send back to the home page
        header("Location: /");
    }
}