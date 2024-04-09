<?php
namespace App;

class VerificationController {
    //This class will be used to verify the input in a form
    public function verificationRegister(array $values): array {
        //return an array with the results (bool) and an array of errors to replace in a controller
        //set the variables for the return before combining them in an array
        $valuesAreCorrect = true;
        $textError = "";
        $interestsError = "";
        $policyError = "";

        if(
            !$this->checkInputTextFilled($values["input_firstName"]) ||
            !$this->checkInputTextFilled($values["input_lastName"]) ||
            !$this->checkInputTextFilled($values["input_email"]) ||
            !$this->checkInputTextFilled($values["input_profession"])
        ) {
            $valuesAreCorrect = false;
            $textError = "Every input should be filled";
        }
        if(!$this->checkboxFilled($values["checkbox_interests"])) {
            $valuesAreCorrect = false;
            $interestsError = "At least one interests should be checked";
        }
        if(!$this->checkboxFilled($values["checkbox_policy"])) {
            $valuesAreCorrect = false;
            $policyError = "Please confirm that you've read our policy";
        }

        $resultArray = ["result" => $valuesAreCorrect, "errors" => array("textInput" => $textError, "interestsCheckbox" => $interestsError, "policyCheckbox" => $policyError)];
        return $resultArray;
    }

    private function checkInputTextFilled(string $input): bool {
        //check if the text input are filled
        return strlen($input) != 0;
    }

    private function checkboxFilled($checkbox): bool {
        return $checkbox != null;
    }
}