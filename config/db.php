<?php
// db.php - Database connection
$servername = "localhost";   // Change this if your database is on a different server
$username = "root";          // Change this if you're using a different username
$password = "";              // Change this if you're using a password
$dbname = "appointment_system"; // The name of your database

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
