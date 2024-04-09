<?php
namespace App\Controller;
use App\BaseController;
use App\Model\Newsletter;
use App\Model\User;

class DashboardController extends BaseController {
    public function displayDashboard() {
        //fetch every newsletters and users
        $curlNewsletters = $this->curlGetEveryNewsletter();
        $curlUsers = $this->curlGetEveryRegistration();

        //transfer every data in the json in a Newsletter class if they have the pending status
        $newslettersPending = [];
        for($i = 0; $i < count($curlNewsletters); $i++) {
            if($curlNewsletters[$i]["status"] === "pending") {
                $userSubscribed = [];
                for($j = 0; $j < count($curlUsers); $j++) {
                    $matchResult = array_intersect($curlNewsletters[$i]["interests"],$curlUsers[$j]["interests"]);
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
                $newslettersPending[] = new Newsletter(
                    $curlNewsletters[$i]["id"], 
                    $curlNewsletters[$i]["title"], 
                    $curlNewsletters[$i]["content"], 
                    $curlNewsletters[$i]["interests"],
                    $curlNewsletters[$i]["status"],
                    $userSubscribed
                );
            }
        }

        $this->render("dashboard.view", ["newslettersPending" => $newslettersPending]);
    }
}