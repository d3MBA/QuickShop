<?php
include 'src/db.php'; // include database connection file

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

<?php require_once 'template/navigation_bar.php';?>

<h2>Bestselling Products</h2>

<!-- Search bar -->
<input type="text" id="searchInput" placeholder="Search for a product...">

<!-- List products -->
<div class="product-list">
    <?php
    $products = $result->fetchAll();

    if ($products) {
        foreach ($products as $row) {
            $imagePath = "images/products/" . strtolower($row["name"]) . ".png";

            echo "<div class='product-box'>";
            echo "<h3>" . $row["name"] . "</h3>";
            echo "<a href='productPage.php?product_id=" . $row["product_id"] . "'>
                    <img src='" . $imagePath . "' alt='" . $row["name"] . "' width='150'>
                  </a>";
            echo "<p>Price: €" . $row["price"] . "</p>";
            echo "<button class='add-to-cart'>Add to Trolley</button>";
            echo "</div>";
        }
    } else {
        echo "No products found.";
    }
    ?>
</div>

<?php require_once 'template/footer.php';?>

</body>
</html>
