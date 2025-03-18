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
        <li><a href="login.php">Log in</a></li>
        <li><a href="register.php">Register</a></li>
    </ul>
</nav>


<h2>Bestselling Products</h2>

<!-- NEW COMMENT -->
<input type="text" id="searchInput" placeholder="Search for a product...">

<!-- List products -->
<div>
    <?php
    if ($result->num_rows > 0) { // check if there are products in the database
        // loop through products and display them
        for ($i = 0; $i < $result->num_rows; $i++) {
            $row = $result->fetch_assoc();

            $imagePath = "images/products/" . strtolower($row["name"]) . ".png"; // image name is based on product name (lowercase)

            // display product details
            echo "<h3>" . $row["name"] . "</h3>";
            echo "<a href='productPage.php?product_id=" . $row["product_id"] . "'><img src='" . $imagePath . "' alt='" . $row["name"] . "' width='150'></a>";
            echo "<p>Price: $" . number_format($row["price"], 2) . "</p>";
            // add button "add to trolley"
            echo "<button>Add to Trolley</button>";
        }
    } else {
        echo "No products found.";
    }
    ?>
</div>

</body>
</html>
