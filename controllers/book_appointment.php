 <?php
// Include the database connection
include('db.php');
session_start();

if (isset($_SESSION['user_id'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get form input
        $user_id = $_SESSION['user_id']; // Logged in user
        $appointment_date = mysqli_real_escape_string($conn, $_POST['appointment_date']);
        $appointment_time = mysqli_real_escape_string($conn, $_POST['appointment_time']);
        $appointment_datetime = $appointment_date . ' ' . $appointment_time; // Combine date and time

        // Insert appointment into the database
        $query = "INSERT INTO appointments (user_id, appointment_date) VALUES ('$user_id', '$appointment_datetime')";
        
        if (mysqli_query($conn, $query)) {
            echo "Appointment booked successfully!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
} else {
    echo "Please log in first.";
}

mysqli_close($conn);
?>

