<?php
// Include the database connection
include_once('../config/db.php');

// Start the session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $doctor = $_POST['doctor'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $message = $_POST['message'];

    // Assuming a user is logged in, retrieve the user_id from session
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id']; // Get the logged-in user's ID
    } else {
        // If no user is logged in, redirect to login page
        header("Location: login.html");
        exit();
    }

    // Prepare and execute the SQL query to insert the appointment into the database
    try {
        $sql = "INSERT INTO appointments (user_id, doctor_name, appointment_date, appointment_time, message, status)
                VALUES (:user_id, :doctor_name, :appointment_date, :appointment_time, :message, 'scheduled')";
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':doctor_name', $doctor);
        $stmt->bindParam(':appointment_date', $appointment_date);
        $stmt->bindParam(':appointment_time', $appointment_time);
        $stmt->bindParam(':message', $message);

        // Execute the query
        $stmt->execute();

        // Redirect to a confirmation page or display a success message
        header("Location: appointment_confirmation.php");
        exit();
    } catch (PDOException $e) {
        // Handle error in case of any issues with the query execution
        die("ERROR: Could not execute query. " . $e->getMessage());
    }
}
?>
