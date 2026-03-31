<?php
// db.php - Database connection file
$host = "localhost";
$user = "root";      // Change if different
$pass = "";          // Change if you have password
$db = "mwalo_portfolio";

// Create connection
$conn = mysqli_connect($host, $user, $pass, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set charset to UTF-8
mysqli_set_charset($conn, "utf8");


?>