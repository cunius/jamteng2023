<?php
$servername = "localhost";
$dbUsername = "****"; // Replace with your MySQL username
$dbPassword = "****"; // Replace with your MySQL password
$dbName = "****"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
