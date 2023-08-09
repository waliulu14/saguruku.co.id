<?php
// Database configuration
$servername = "localhost"; // Replace with your database server name
$username = "docu6289_saguruku12"; // Replace with your database username
$password = "huliselan14"; // Replace with your database password
$dbname = "docu6289_saguruku"; // Replace with your database name

// Create a database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
