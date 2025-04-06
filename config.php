<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "quickshop";
$port = 3308; // port defualt port 3306

$dsn = "mysql:host=$host;port=$port;dbname=$dbname";
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);