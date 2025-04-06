<?php
require_once 'src/db.php';
require_once 'User.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['emailAddress'] ?? '';
    $password = $_POST['password'] ?? '';

    $sql = "SELECT * FROM customers WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email, $password]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $user = new User();
        $user->user_id = $result['customerID'];
        $user->name = $result['name'];
        $user->email = $result['email'];
        $user->password = $result['password'];
        $user->address = $result['address'];
        $user->phoneNumber = $result['phone'];

        header("Location: index.php");
        exit;
    } else {
        $message = "<p style='color:red;'>Invalid email or password!</p>";
    }
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

<?php require_once 'template/footer.php';?>

</body>
</html>
