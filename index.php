<?php
include 'db.php'; // include database connection file

// query database to fetch all products
$query = "SELECT * FROM products";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>QuickShop - Online Grocery Shop</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- Navigation bar -->
<nav>
    <div class="logo">QuickShop</div>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="order_history.php">Orders</a></li>
        <li><a href="manage_profile.php">Manage Profile</a></li>
        <li><a href="login.php">Log in</a></li>
        <li><a href="register.php">Register</a></li>
    </ul>
</nav>

<h2>Bestselling Products</h2>

<!-- Search bar -->
<input type="text" id="searchInput" placeholder="Search for a product...">

<!-- List products -->
<div class="product-list">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $imagePath = "images/products/" . strtolower($row["name"]) . ".png";

            echo "<div class='product-box'>";
            echo "<h3>" . $row["name"] . "</h3>";
            echo "<a href='productPage.php?product_id=" . $row["product_id"] . "'>
                    <img src='" . $imagePath . "' alt='" . $row["name"] . "' width='150'>
                  </a>";
            echo "<p>Price: €" . number_format($row["price"], 2) . "</p>";
            echo "<button class='add-to-cart'>Add to Trolley</button>";
            echo "</div>";
        }
    } else {
        echo "No products found.";
    }
    ?>
</div>


<!-- Footer -->
<footer style="background-color: #333; color: white; padding: 40px 20px; margin-top: 40px;">
    <div style="display: flex; flex-wrap: wrap; justify-content: space-around; max-width: 1000px; margin: auto;">
        <div>
            <h3>About QuickShop</h3>
            <p><a href="#" style="color: white;">About us</a></p>
            <p><a href="#" style="color: white;">Contact us</a></p>
        </div>
        <div>
            <h3>Useful Links</h3>
            <p><a href="order_history.php" style="color: white;">Order History</a></p>
            <p><a href="manage_profile.php" style="color: white;">Manage Profile</a></p>
            <p><a href="login.php" style="color: white;">Login</a></p>
        </div>
        <div>
            <h3>Follow Us</h3>
            <p>
                <a href="#" style="color: white; margin-right: 10px;">Facebook</a>
                <a href="#" style="color: white; margin-right: 10px;">Instagram</a>
                <a href="#" style="color: white;">YouTube</a>
            </p>
        </div>
    </div>
</footer>


</body>
</html>
