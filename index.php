<?php
    $bestsellers = [
        ["name" => "Apple", "price" => 0.99, "description" => "Fresh, juicy apples", "image" => "images/apple.jpg"],
        ["name" => "Banana", "price" => 1.99, "description" => "Fresh bannanas", "image" => "iamges/banana.jpg"],
        ["name" => "Orange", "price" => 2.99, "description" => "Fresh oranges", "image" => "images/orange.jpg"],
        ["name" => "Pineapple", "price" => 3.99, "description" => "Fresh pineapples", "image" => "images/pineapple.jpg"],
        ["name" => "Rice", "price" => 4.99, "description" => "Fresh rice", "image" => "images/rice.jpg"],
    ];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>QucikShop - Online Grocery</title>
    </head>
    <body>
    <h2>Top 5 Bestselling Products</h2>
    <!-- search Bar -->
    <input type="text" id="searchInput" placeholder="Search for a product...">

    <!--  list best sellers products  -->
        <div>
            <?php
            // Loop to display bestsellers
            for ($i = 0; $i < count($bestsellers); $i++) {
                echo "<h3>" . $bestsellers[$i]["name"] . "</h3>";
                echo "<img src='" . $bestsellers["image"] . "' alt='" . $bestsellers["name"] . "' width='150'>";
                echo "<p>Price: $" . $bestsellers[$i]["price"] . "</p>";
                echo "<p>Description: $" . $bestsellers[$i]["description"] . "</p>";
            }
            ?>
        </div>
    </body>
</html>