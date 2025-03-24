<?php

include 'db.php'; // database connection file

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
        if ($email === $this->email && $password === $this->password) {
            return true;
        }
        return false;
    }

    public function register($name, $email, $password, $address, $phoneNumber)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->address = $address;
        $this->phoneNumber = $phoneNumber;
    }
}

// ustomer class inherits from User
class Customer extends User
{
    public function updateAddress($conn, $newAddress)
    {
        $sql = "UPDATE customers SET address = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $newAddress, $this->email);

        if ($stmt->execute()) {
            echo "<p style='color:green;'>Address updated!</p>";
            $this->address = $newAddress;
        } else {
            echo "<p style='color:red;'>Error updating address.</p>";
        }

        $stmt->close();
    }

    public function changePassword($conn, $currentPassword, $newPassword)
    {
        $sql = "SELECT password FROM customers WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $this->email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row && $row['password'] === $currentPassword) {
            $stmt->close();
            $updateSql = "UPDATE customers SET password = ? WHERE email = ?";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bind_param("ss", $newPassword, $this->email);

            if ($updateStmt->execute()) {
                echo "<p style='color:green;'>Password changed successfully!</p>";
            } else {
                echo "<p style='color:red;'>Failed to change password.</p>";
            }

            $updateStmt->close();
        } else {
            echo "<p style='color:red;'>Current password is incorrect.</p>";
        }
    }
}

// admin class inherits from User
class Admin extends User
{
    public function addProduct($conn, $name, $price, $description)
    {

    }
}
?>
