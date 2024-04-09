<?php
namespace App;

use App\Model\Newsletter;
use App\Model\User;

class BaseController {
    private string $urlRegistrations = "http://51.91.108.32/registrations";
    private string $urlNewsletter = "http://51.91.108.32/newsletters";

    protected function render(string $fileName, array $data = []) {
        //render a view page with the name of the file and an array of datas if not empty
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
        //Fetch every Newsletters on the db
        
        //initiate curl
        $ch = curl_init($this->urlNewsletter);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch); 
        //transform the json into an normal array
        return json_decode($result, true);
    }

    protected function curlGetNewsletterById(string $id): array {
        //Fetch a Newsletter with an id
        
        //initiate curl
        $ch = curl_init($this->urlNewsletter . "/$id");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch); 
        //transform the json into an normal array
        return json_decode($result, true);
    }

    protected function curlSendRegistration(User $data, string $operation = "POST") {
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
        curl_exec($ch);
        //close curl once the request is completed
        curl_close($ch);
    }

    protected function curlUpdateNewsletterStatus(Newsletter $data) {
        //change the satus and then convert the data as a json
        $idNewsletter = $data->id;
        $data->status = "send";
        $data = $data->transformIntoArray();
        $jsonData = json_encode($data);

        //initiate curl and set the necesary parameters for the request
        $ch = curl_init($this->urlNewsletter . "/$idNewsletter");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        //close curl once the request is completed
        curl_close($ch);
    }

    //automatically get the next available Register id for the post method
    protected function curlIncrementIdRegister(): string {
        $list = $this->curlGetEveryRegistration();
        return strval(count($list) + 1);
    }

    //fetch every pending newsletter and match the users for each one of them
    protected function getEveryPendingNewsletter(array $newslettertoProcess): array {
        //fetch every users
        $curlUsers = $this->curlGetEveryRegistration();

        //transfer every data in the json containing pending newsletter in a array full of Newsletter class
        $newsletters = [];
        for($i = 0; $i < count($newslettertoProcess); $i++) {
            if($newslettertoProcess[$i]["status"] === "pending") {
                $userSubscribed = [];
                for($j = 0; $j < count($curlUsers); $j++) {
                    $matchResult = array_intersect($newslettertoProcess[$i]["interests"],$curlUsers[$j]["interests"]);
                    if(count($matchResult) != 0) {
                        $userSubscribed[] = new User(
                            $curlUsers[$j]["id"],
                            $curlUsers[$j]["firstName"],
                            $curlUsers[$j]["lastName"],
                            $curlUsers[$j]["email"],
                            $curlUsers[$j]["profession"],
                            $curlUsers[$j]["interests"],
                            $curlUsers[$j]["register"],
                            $curlUsers[$j]["registerAt"]
                        );
                    } 
                }
                $newsletters[] = new Newsletter(
                    $newslettertoProcess[$i]["id"], 
                    $newslettertoProcess[$i]["title"], 
                    $newslettertoProcess[$i]["content"], 
                    $newslettertoProcess[$i]["interests"],
                    $newslettertoProcess[$i]["status"],
                    $userSubscribed
                );
            }
        }
        return $newsletters;
    }
}