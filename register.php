<?php
require_once 'db.php';
require_once 'User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['firstName'] ?? '';
    $lastName = $_POST['lastName'] ?? '';
    $emailAddress = $_POST['emailAddress'] ?? '';
    $phoneNumber = $_POST['phoneNumber'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';

    if ($password !== $confirmPassword) {
        echo "<p style='color:red;'>Passwords do not match!</p>";
    } else {
        $fullName = trim($firstName . ' ' . $lastName);
        $address = '';

        $user = new User();
        $user->register($fullName, $emailAddress, $password, $address, $phoneNumber);
        $user->saveToDB($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - QuickShop</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <h2>Register</h2>
    <form action="" method="POST">
        <p><strong>First name:</strong></p>
        <input type="text" name="firstName" required>

        <p><strong>Last name:</strong></p>
        <input type="text" name="lastName" required>

        <p><strong>Email address:</strong></p>
        <input type="email" name="emailAddress" required>

        <p><strong>Phone number:</strong></p>
        <input type="text" name="phoneNumber" required>

        <p><strong>Create password:</strong></p>
        <input type="password" name="password" required>

        <p><strong>Confirm password:</strong></p>
        <input type="password" name="confirmPassword" required>

        <br><br>
        <button type="submit">Register</button>
    </form>

    <br>
    <a href="login.php">Already registered? Log In</a>
</div>

</body>
</html>
