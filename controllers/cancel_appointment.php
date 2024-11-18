<?php
// db.php - Database connection
include('db.php');
session_start();

if (isset($_SESSION['user_id'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get the appointment ID from the form input
        $appointment_id = mysqli_real_escape_string($conn, $_POST['appointment_id']);
        $user_id = $_SESSION['user_id'];  // Get the user ID from the session
        
        // Query to delete the appointment
        $query = "DELETE FROM appointments WHERE id = '$appointment_id' AND user_id = '$user_id'";

        if (mysqli_query($conn, $query)) {
            echo "Appointment canceled successfully!";
            // Redirect to the user's appointments page or dashboard
            header("Location: dashboard.html");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
} else {
    echo "Please log in first.";
}

mysqli_close($conn);
?>
