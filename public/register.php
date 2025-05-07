<?php
session_start();
require_once '../classes/User.php';

require_once '../template/header.php';
require_once '../template/nav.php';

$name = $email = $phone = "";
$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name'])) {
        $name = sanitize_input($_POST['name']);
    } else {
        $name = '';
    }
    if (isset($_POST['email'])) {
        $email = sanitize_input($_POST['email']);
    } else {
        $email = '';
    }

    if (isset($_POST['pass'])) {
        $pass = sanitize_input($_POST['pass']);
    } else {
        $pass = '';
    }

    if (isset($_POST['confirm'])) {
        $confirm = sanitize_input($_POST['confirm']);
    } else {
        $confirm = '';
    }
    if (isset($_POST['phone'])) {
        $phone = sanitize_input($_POST['phone']);
    } else {
        $phone = '';
    }


    $user = new User();
    $msg = $user->register($name, $email, $pass, $confirm, $phone);


    if ($msg === "success") {
        header('Location: login.php?registered=true');
        exit;
    }
}
?>

<!doctype html>
<html>


<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>


<div class="auth-container">
    <h3>Register</h3>

    <?php if ($msg && $msg !== "success") echo "<div class='alert alert-danger'>$msg</div>"; ?>

    <form method="post">
        <div class="mb-2">
            <input class="form-control" name="name" placeholder="Full Name" required value="<?php echo htmlspecialchars($name); ?>">
        </div>

        <div class="mb-2">
            <input class="form-control" name="email" type="email" placeholder="Email" required value="<?php echo htmlspecialchars($email); ?>">
        </div>

        <div class="mb-2">
            <input class="form-control" name="pass" type="password" placeholder="Password" required>
        </div>

        <div class="mb-2">
            <input class="form-control" name="confirm" type="password" placeholder="Confirm Password" required>
        </div>
        <div class="mb-2">
            <input class="form-control" name="phone" type="number" placeholder="Phone" required value="<?php echo htmlspecialchars($phone); ?>">
        </div>

        <button class="btn btn-success">Register</button>
        <a href="login.php" class="btn btn-link">Already registered? Log In.</a>
    </form>
</div>

    </body>
</html>



<?php require_once '../template/footer.php'; ?>