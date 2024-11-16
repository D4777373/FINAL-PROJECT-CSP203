<?php
// Database configuration
define('DB_SERVER', 'localhost');         // MySQL server
define('DB_USERNAME', 'root');            // MySQL username
define('DB_PASSWORD', 'Dipanjan@2004');   // MySQL root password
define('DB_DATABASE', 'healthcare_management'); // Your database name

try {
    // Create a new PDO instance
    $pdo = new PDO(
        'mysql:host=' . DB_SERVER . ';dbname=' . DB_DATABASE, 
        DB_USERNAME, 
        DB_PASSWORD
    );

    // Set the PDO error mode to exception for better error handling
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Test the connection (optional)
    // echo "Database connected successfully.";
} catch (PDOException $e) {
    // Handle connection error
    die("ERROR: Could not connect. " . $e->getMessage());
}
?>
