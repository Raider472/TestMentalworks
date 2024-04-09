<?php
namespace App\Model;

class Newsletter {
    //This class is used to gather the data of a newsletter in the db
    public string $id;
    public string $title;
    public string $content;
    public array $interests;
    public string $status;
    public array $subscribedUsers;

    public function __construct(string $id, string $title, string $content, array $interests, string $status, array $users) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->interests = $interests;
        $this->status = $status;
        $this->subscribedUsers = $users;
    }
}