<?php
global $conn;
include 'db.php'; // include database connection file

// query database to fetch all products
$query = "SELECT * FROM products";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase History</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- Navigation bar -->
<nav>
    <div class="logo">QuickShop</div>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="order_history.php">Orders</a></li>
        <li><a href="login.php">Log in</a></li>
        <li><a href="register.php">Register</a></li>
    </ul>
</nav>

<!-- Order History Content -->
<div id="order-history" class="container">
    <h2>Purchase History</h2>
    <div class="order">
        <p><strong>Ordered on:</strong> 19/02/2025</p>

        <div class="item">
            <span>Bananas (2)</span>
            <span>€1.50</span>
        </div>
        <div class="item">
            <span>Whole Milk (1)</span>
            <span>€2.99</span>
        </div>

        <p><strong>Delivery Address:</strong></p>
        <p>18 Captain's Avenue<br>Dublin, D12 W62N</p>

        <p class="total">Total: €4.49</p>
    </div>
</div>

</body>
</html>