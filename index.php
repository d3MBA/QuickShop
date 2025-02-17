<?php
$bestsellers = [
    ["name" => "Apple", "price" => 0.99, "description" => "Fresh, juicy apples"],
    ["name" => "Banana", "price" => 1.99, "description" => "Fresh bananas"],
    ["name" => "Orange", "price" => 2.99, "description" => "Fresh oranges"],
    ["name" => "Pineapple", "price" => 3.99, "description" => "Fresh pineapples"],
    ["name" => "Rice", "price" => 4.99, "description" => "Fresh rice"],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>QuickShop - Online Grocery</title>
</head>
<body>
<h2>Top 5 Bestselling Products</h2>

<!-- Search Bar -->
<input type="text" id="searchInput" placeholder="Search for a product...">

<!-- list bestsellers products -->
<div>
    <?php
    for ($i = 0; $i < count($bestsellers); $i++) {
        // create the correct image path dynamically
        $imagePath = "images/products/" . strtolower($bestsellers[$i]["name"]) . ".png"; // strtolower converts string to lowercase

        echo "<h3>" . $bestsellers[$i]["name"] . "</h3>";
        echo "<a href='product.php'><img src='" . $imagePath . "' alt='" . $bestsellers[$i]["name"] . "' width='150'></a>";
        echo "<p>Price: $" . number_format($bestsellers[$i]["price"], 2) . "</p>"; // number_format format number to 2 decimal placees
        echo "<p>Description: " . $bestsellers[$i]["description"] . "</p>";
    }
    ?>
</div>
</body>
</html>
