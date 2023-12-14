<?php
// Establish connection to your database
$servername = "127.0.0.1";
$username = "Admin";
$password = "rootaccess";
$dbname = "loginpanel";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update the 'report' table to set 'seen' column to 1
$updateSql = "UPDATE report SET seen = 1"; // Update this query according to your table structure

$conn->close();
?>
