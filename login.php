<?php
require_once 'db.php';
require_once 'User.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['emailAddress'] ?? '';
    $password = $_POST['password'] ?? '';

    $sql = "SELECT * FROM customers WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        $user = new User();
        $user->user_id = $row['customerID'];
        $user->name = $row['name'];
        $user->email = $row['email'];
        $user->password = $row['password'];
        $user->address = $row['address'];
        $user->phoneNumber = $row['phone'];

        header("Location: index.php");
        exit;
    } else {
        $message = "<p style='color:red;'>Invalid email or password!</p>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log in - QuickShop</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <h2>Log in</h2>

    <?= $message ?>

    <form action="" method="POST">
        <p><strong>Email address:</strong></p>
        <input type="email" name="emailAddress" required>

        <p><strong>Password:</strong></p>
        <input type="password" name="password" required>

        <br><br>
        <button type="submit">Log in</button>
    </form>

    <br>
    <a href="register.php">No account yet?</a>
</div>

</body>
</html>
