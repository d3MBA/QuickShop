<?php

require_once '../src/db.php';

function sanitize_input($data) // sanitize input data
{
    $data = trim($data); // https://www.w3schools.com/PHP/func_string_trim.asp
    $data = stripslashes($data); // https://www.w3schools.com/PHP/func_string_stripslashes.asp
    return htmlspecialchars($data); // https://www.w3schools.com/PHP/func_string_htmlspecialchars.asp
}

class User
{
    protected $db;

    public function __construct() // https://www.w3schools.com/php/php_oop_constructor.asp
    {
        global $conn;
        $this->db = $conn;
    }

    public function emailExists($email)
    {
        $sql = "SELECT 1 FROM customers WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetchColumn();
    }

    public function register($name, $email, $pass, $confirm, $phone)
    {
        if ($pass !== $confirm) {
            return "Passwords do not match.";
        }

        if ($this->emailExists($email)) {
            return "Email already registered.";
        }


        $sql = "INSERT INTO customers (name, email, password, phone, permission_level) VALUES (?, ?, ?, ?, 0)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$name, $email, $pass, $phone]);

        return "success";
    }

    public function login($email, $pass)
    {
        $sql = "SELECT * FROM customers WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && $row['password'] === $pass) {
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_id'] = $row['customerID'];
            $_SESSION['staff'] = $row['permission_level'];
            return true;
        }
        return false;
    }

    public function changePassword($old, $new)
    {

        $sql = "SELECT password FROM customers WHERE customerID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$_SESSION['user_id']]);
        $row  = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row || $row['password'] !== $old) {
            return "Old password is incorrect.";
        }

        // update password
        $sql = "UPDATE customers SET password = ? WHERE customerID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$new, $_SESSION['user_id']]);

        return "success";
    }
}
