<?php

class User
{

    public $user_id;
    public $name;
    public $email;
    public $password;
    public $address;
    public $phoneNumber;

    public function login($email, $password)
    {
        if ($email == $this->email && $password == $this->password) {
            return true;
        } else {
            return false;
        }
    }

    public function register($name, $email, $password, $address, $phoneNumber)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->address = $address;
        $this->phoneNumber = $phoneNumber;
    }

    public function displayUser()
    {
        echo "<br>Name: " . $this->name;
        echo "<br>Email: " . $this->email;
        echo "<br>Address: " . $this->address;
        echo "<br>Phone Number: " . $this->phoneNumber;
    }
}