<?php
$servername = "localhost";
$dbUsername = "cunius"; // Replace with your MySQL username
$dbPassword = "Cunius9!8"; // Replace with your MySQL password
$dbName = "jamteng"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
