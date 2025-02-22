<?php
    $host = "localhost";
    $user = "root"; // Change this if you have a different MySQL user
    $password = ""; // Set your MySQL password if needed
    $dbname = "quickshop";

    // Create connection
    $conn = new mysqli($host, $user, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>
