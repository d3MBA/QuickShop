<?php
class User {
    public $user_id;
    public $name;
    public $email;
    public $password;
    public $address;
    public $phoneNumber;

    public function register($fullName, $email, $password, $address, $phone, $confirmPassword) {
        if ($password !== $confirmPassword) {
            return "Passwords do not match.";
        }

        if (!preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password)) {
            return "Password must have at least 1 capital letter and 1 number";
        }

        $this->name = $fullName;
        $this->email = $email;
        $this->password = $password;
        $this->address = $address;
        $this->phoneNumber = $phone;

        return "OK";
    }

    public function saveToDB($conn) {
        $query = "INSERT INTO customers (name, email, password, address, phone) 
                  VALUES ('$this->name', '$this->email', '$this->password', '$this->address', '$this->phoneNumber')";
        $conn->query($query);
    }

    public function updateAddress($conn, $newAddress) {
        $query = "UPDATE customers SET address = '$newAddress' WHERE email = '$this->email'";
        $conn->query($query);
    }

    public function changePassword($conn, $currentPassword, $newPassword) {
        $query = "SELECT password FROM customers WHERE email = '$this->email'";
        $stmt = $conn->query($query);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && $row['password'] == $currentPassword) {
            $updateQuery = "UPDATE customers SET password = '$newPassword' WHERE email = '$this->email'";
            $conn->query($updateQuery);
            echo "<p style='color:green;'>Password updated successfully!</p>";
        } else {
            echo "<p style='color:red;'>Current password is incorrect.</p>";
        }
    }
}
?>
