<?php
session_start();

require_once '../classes/User.php';

require_once '../template/header.php';
require_once '../template/nav.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user = new User();
$msg  = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['old_pass'])) {
        $old = trim($_POST['old_pass']);
    } else {
        $old = '';
    }

    if (isset($_POST['new_pass'])) {
        $new = trim($_POST['new_pass']);
    } else {
        $new = '';
    }


    if ($old === '' || $new === '') {
        $msg = "Please fill in both boxes.";

    } else {

        $result = $user->changePassword($old, $new);

        if ($result === "success") {
            $msg = "Password updated!";
        } else {
            $msg = $result;
        }

    }
}
?>

<!doctype html>
<html>
<head>
    <title>Manage Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<div class="auth-container">
    <h3>Change Password</h3>

    <?php if ($msg) echo '<div class="alert alert-info">' .htmlspecialchars($msg). '</div>'; ?>

    <form method="post">
        <div class="mb-3">
            <input type="password" name="old_pass" class="form-control" placeholder="Old Password" required>
        </div>
        <div class="mb-3">
            <input type="password" name="new_pass" class="form-control" placeholder="New Password" required>
        </div>

        <button class="btn btn-primary">Update Password</button>
        <a href="index.php" class="btn btn-secondary w-100 mt-2">Back</a>
    </form>
</div>


    </body>

</html>

<?php require_once '../template/footer.php'; ?>