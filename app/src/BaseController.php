<?php
namespace App;

use App\Model\Newsletter;
use App\Model\User;

class BaseController {
    private string $urlRegistrations = "http://51.91.108.32/registrations";
    private string $urlNewsletter = "http://51.91.108.32/newsletters";

    protected function render(string $fileName, array $data = []) {
        //render a view page with the name of the file and an array of data if not empty
        if(count($data) != 0) {
            extract($data);
        }
        include "View/$fileName.php";
    }

    protected function curlGetEveryRegistration(): array {
        //Fetch every Registrations on the db

        //initiate curl
        $ch = curl_init($this->urlRegistrations);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch); 

        //transform the json into an normal array
        return json_decode($result, true);
    }

    protected function curlGetEveryNewsletter(): array {
        //Fetch every Newsletter on the db
        
        //initiate curl
        $ch = curl_init($this->urlNewsletter);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch); 

        //transform the json into an normal array
        return json_decode($result, true);
    }

    protected function curlSendRegistration(string $operation, User $data) {
        //convert the data as an array and the convert it as a json
        $data = $data->transformIntoArray();
        $jsonData = json_encode($data);

        //initiate curl and set the necesary parameters for the request
        $ch = curl_init($this->urlRegistrations);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        if($operation === "PUT") {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        }
        else {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        }
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //for debuging purpose
        $result = curl_exec($ch);
        //close curl once the request is completed
        curl_close($ch);
    }
}