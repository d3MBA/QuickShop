<?php
include 'src/db.php'; // connect to database

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // get product details from database
    $query = "SELECT * FROM products WHERE product_id = $product_id";
    $result = $conn->query($query);

    $product = $result->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        echo "Product not found";
        exit;
    }
} else {
    echo "Invalid product id";
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $product['name']; ?> - QuickShop</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- Navigation bar -->
<nav>
    <div class="logo">QuickShop</div>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="categories.php">Categories</a></li>
        <li><a href="order_history.php">Purchase History</a></li>
        <li><a href="login.php">Log in</a></li>
    </ul>
</nav>

<h2>Product description page</h2>

<div class="product-container">
    <img src="images/products/<?php echo strtolower($product['name']); ?>.png" alt="<?php echo $product['name']; ?>">
    <div class="product-details">
        <h1><?php echo $product['name']; ?></h1>
        <p class="price">€<?php echo number_format($product['price'], 2); ?></p>
        <h3>Product Description:</h3>
        <p><?php echo $product['description']; ?></p>
        <button class="add-to-cart">Add to Trolley</button>
    </div>
</div>

</body>
</html>
