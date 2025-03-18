<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "quickshop";
    $port = 3308;

// create connection
$conn = new mysqli($host, $user, $password, $dbname, $port = 3308);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
