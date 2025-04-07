<?php
require_once 'src/db.php';
require_once 'User.php';

session_start();

$user = new User();
$user->email = $_SESSION['email'] ?? ''; // get logged in user email

$message = "";

// load current info
if (!empty($user->email)) {
    $sql = "SELECT * FROM customers WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$user->email]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $user->name = $row['name'];
        $user->address = $row['address'];
        $user->phoneNumber = $row['phone'];
    }
}

// handle address update
if (isset($_POST['updateAddress'])) {
    $newAddress = $_POST['newAddress'] ?? '';
    if (!empty($newAddress)) {
        $user->updateAddress($conn, $newAddress);
        $user->address = $newAddress;
    }
}

// handle password change
if (isset($_POST['changePassword'])) {
    $currentPassword = $_POST['currentPassword'] ?? '';
    $newPassword     = $_POST['newPassword'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';

    if ($newPassword !== $confirmPassword) {
        $message = "<p style='color:red;'>New passwords do not match.</p>";
    } else {
        ob_start();
        $user->changePassword($conn, $currentPassword, $newPassword);
        $message = ob_get_clean();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Profile - QuickShop</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php require_once 'template/navigation_bar.php'; ?>


<div class="container">
    <h2>Manage Profile</h2>

    <p><strong>Name:</strong> <?= $user->name ?></p>
    <p><strong>Email:</strong> <?= $user->email ?></p>
    <p><strong>Phone:</strong> <?= $user->phoneNumber ?></p>
    <p><strong>Current Address:</strong> <?= $user->address ?></p>

    <hr><br>

    <!-- Update Address Form -->
    <form action="" method="POST">
        <p><strong>New Address:</strong></p>
        <input type="text" name="newAddress" placeholder="Enter new address..." required>
        <button type="submit" name="updateAddress">Update Address</button>
    </form>

    <br><hr><br>

    <!-- Change Password Form -->
    <?= $message ?>
    <form action="" method="POST">
        <p><strong>Current Password:</strong></p>
        <input type="password" name="currentPassword" required>

        <p><strong>New Password:</strong></p>
        <input type="password" name="newPassword" required>

        <p><strong>Confirm New Password:</strong></p>
        <input type="password" name="confirmPassword" required>

        <button type="submit" name="changePassword">Change Password</button>
    </form>

    <br>
    <a href="index.php">Back to Home</a>
</div>

<?php require_once 'template/footer.php'; ?>

</body>
</html>
