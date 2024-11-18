<?php
// Include the database connection file
include('db.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $patientName = $_POST['patientName'];
    $doctor = $_POST['doctor'];
    $appointmentDate = $_POST['appointmentDate'];
    $appointmentTime = $_POST['appointmentTime'];

    // Fetch user ID from the 'users' table based on the patient name
    $userResult = $conn->query("SELECT id FROM users WHERE username = '$patientName'");
    
    if ($userResult->num_rows > 0) {
        $user = $userResult->fetch_assoc();
        $userId = $user['id'];
        
        // Fetch doctor ID from the 'doctors' table based on the doctor name
        $doctorResult = $conn->query("SELECT id FROM doctors WHERE name = '$doctor'");
        
        if ($doctorResult->num_rows > 0) {
            $doctorData = $doctorResult->fetch_assoc();
            $doctorId = $doctorData['id'];
            
            // Insert the appointment into the 'appointments' table
            $sql = "INSERT INTO appointments (user_id, doctor_id, appointment_date, status) 
                    VALUES ('$userId', '$doctorId', '$appointmentDate $appointmentTime', 'scheduled')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Appointment booked successfully!'); window.location.href = 'appointment_booking.html';</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Doctor not found.";
        }
    } else {
        echo "User not found.";
    }

    // Close the database connection
    $conn->close();
}
?>
