<?php
include('db.php'); // include database connection file

// query database to fetch all products
$query = "SELECT * FROM products";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>QuickShop - Online Grocery</title>
</head>
<body>

<!--Navigation bar -->
<nav>
    <a href="index.php">Home</a>
    <a href="login.php">Log in</a>
    <a href="register.php">Register</a>
</nav>

<h2>Top 5 Bestselling Products</h2>

<!-- Search Bar -->
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
            echo "<a href='product.php?id=" . $row["id"] . "'><img src='" . $imagePath . "' alt='" . $row["name"] . "' width='150'></a>";
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
