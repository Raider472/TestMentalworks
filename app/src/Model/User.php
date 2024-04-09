<?php
namespace App\Model;

class User {
    //This class is used to gather and send the data of a registration in the db
    public string $id;
    public string $firstName;
    public string $lastName;
    public string $profession;
    public array $interests;
    public bool $register;
    public string $registerAt;

    public function __construct(string $id, string $firstName, string $lastName, string $profession, array $interests, bool $register, string $registerAt) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->profession = $profession;
        $this->interests = $interests;
        $this->register = $register;
        $this->registerAt = $registerAt;
    }

    public function transformIntoArray(): array {
        //gather all the data inside this class as a single array, it will be useful for the Curl POST/PUT requests
        return array(
            "id" => $this->id,
            "firstName" => $this->firstName,
            "lastName" => $this->lastName,
            "profession" => $this->profession,
            "interests" => $this->interests,
            "register" => $this->register,
            "registerAt" => $this->registerAt,
        );
    }
}