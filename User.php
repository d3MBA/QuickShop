<?php
class User {
    public $fullName;
    public $email;
    public $password;
    public $address;
    public $phone;

    public function register($fullName, $email, $password, $address, $phone) {
        $this->fullName = $fullName;
        $this->email = $email;
        $this->password = $password;
        $this->address = $address;
        $this->phone = $phone;
    }

    public function saveToDB($conn) {
        $query = "INSERT INTO customers (name, email, password, address, phone) VALUES ('$this->fullName', '$this->email', '$this->password', '$this->address', '$this->phone')";
        $conn->query($query);
    }
}
?>