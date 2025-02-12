<?php
// db_connect.php
// Adapt these values to match your XAMPP setup:

$servername = "localhost"; // usually localhost in XAMPP
$username   = "root";      // default XAMPP user
$password   = "";          // default XAMPP password is empty (unless changed)
$dbname     = "my_test_db";// the database name you created in phpMyAdmin

// Create the connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for any errors
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
