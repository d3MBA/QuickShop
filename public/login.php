<?php
session_start();
require_once '../classes/User.php';

require_once '../template/header.php';
require_once '../template/nav.php';

$email = $pass = "";
$msg   = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['email'])) {
        $email = test_input($_POST['email']);
    } else {
        $email = '';
    }

    if (isset($_POST['pass'])) {
            $pass = test_input($_POST['pass']);
    } else {
        $pass = '';
    }



    $user = new User();
    if ($user->login($email, $pass)) {
        header('Location: index.php');
        exit;
    } else {
        $msg = "Wrong email or password.";
    }
}
?>

<!doctype html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h3>Login</h3>

<?php if ($msg) echo "<div class='alert alert-danger'>$msg</div>"; ?>

<form method="post" novalidate>

    <div class="mb-3"><input class="form-control" name="email" type="email" placeholder="Email" required value="<?php echo $email; ?>"></div>
    <div class="mb-3"><input class="form-control" name="pass"  type="password" placeholder="Password" required></div>
    <button class="btn btn-primary">Login</button>
    <a href="register.php" class="btn btn-link">Register</a>

</form>

</body>
</html>

<?php require_once '../template/footer.php'; ?>