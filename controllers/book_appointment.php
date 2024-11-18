<?php
// Include the database connection
include('db.php');
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Sanitize and validate user input
        $user_id = $_SESSION['user_id']; // Logged in user
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $doctor_name = mysqli_real_escape_string($conn, $_POST['doctor']);
        $appointment_date = mysqli_real_escape_string($conn, $_POST['appointment_date']);
        $appointment_time = mysqli_real_escape_string($conn, $_POST['appointment_time']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);

        // Combine date and time into a single DATETIME value
        $appointment_datetime = $appointment_date . ' ' . $appointment_time;

        // Retrieve the doctor_id based on the selected doctor name
        $doctor_query = $conn->prepare("SELECT doctor_id FROM doctors WHERE name = ?");
        $doctor_query->bind_param("s", $doctor_name);
        $doctor_query->execute();
        $doctor_query->bind_result($doctor_id);
        $doctor_query->fetch();
        $doctor_query->close();

        if ($doctor_id) {
            // Prepared statement to prevent SQL injection
            $stmt = $conn->prepare("INSERT INTO appointments (user_id, doctor_id, appointment_date, status, created_at) VALUES (?, ?, ?, 'scheduled', NOW())");
            $stmt->bind_param("iis", $user_id, $doctor_id, $appointment_datetime);

            // Execute the query
            if ($stmt->execute()) {
                echo "Appointment booked successfully!";
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the prepared statement
            $stmt->close();
        } else {
            echo "Selected doctor not found.";
        }
    }
} else {
    // Redirect to login page if the user is not logged in
    header("Location: login.php");
    exit();
}

// Close the database connection
mysqli_close($conn);
?>





