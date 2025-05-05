<?php
    $loggedIn  = isset($_SESSION['user_name']);

    if ($loggedIn) {
        $firstName = strtok($_SESSION['user_name'], ' ');
    } else {
        $firstName = 'Guest';
    }
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
    <div class="container">

        <a class="navbar-brand" href="index.php">QuickShop</a>

        <span class="navbar-text me-auto">
            Hello, <?= htmlspecialchars($firstName) ?>
        </span>


        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home</a></li>
            <li class="nav-item"><a class="nav-link" href="shopping_cart.php"><i class="fas fa-shopping-cart"></i> Trolley</a></li>

            <?php if ($loggedIn) { ?>

                <?php if (!empty($_SESSION['staff']) && $_SESSION['staff']) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="staff_panel.php">
                            <i class="fas fa-user-shield"></i> Staff Panel
                        </a>
                    </li>
                <?php } ?>


                <li class="nav-item">
                    <a class="nav-link" href="order_history.php">
                        <i class="fas fa-box"></i> Orders
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link" href="manage_profile.php">
                        <i class="fas fa-user-cog"></i> Profile
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="logout.php">
                        <i class="fas fa-sign-out-alt"></i> Log&nbsp;out
                    </a>
                </li>


            <?php } ?>


            <?php if (!$loggedIn) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">
                        <i class="fas fa-sign-in-alt"></i> Log&nbsp;in
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link" href="register.php">
                        <i class="fas fa-user-plus"></i> Register
                    </a>
                </li>
            <?php } ?>


        </ul>
    </div>
</nav>
