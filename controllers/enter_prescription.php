<?php
// db.php - Database connection
include('db.php');
session_start();

if (isset($_SESSION['user_id'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get the user ID and prescription data from the form
        $user_id = $_SESSION['user_id'];  // Get the user ID from the session
        $prescription_text = mysqli_real_escape_string($conn, $_POST['prescription_text']);
        
        // Insert the prescription into the database
        $query = "INSERT INTO prescriptions (user_id, prescription_text) VALUES ('$user_id', '$prescription_text')";
        
        if (mysqli_query($conn, $query)) {
            echo "Prescription added successfully!";
            // Redirect to the prescriptions list or dashboard
            header("Location: prescriptions.html");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
} else {
    echo "Please log in first.";
}

mysqli_close($conn);
?>
