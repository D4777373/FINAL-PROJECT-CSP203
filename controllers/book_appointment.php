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
$doctor = mysqli_real_escape_string($conn, $_POST['doctor']);
$appointment_date = mysqli_real_escape_string($conn, $_POST['appointment_date']);
$appointment_time = mysqli_real_escape_string($conn, $_POST['appointment_time']);
$message = mysqli_real_escape_string($conn, $_POST['message']);

// Combine date and time into a single DATETIME value
$appointment_datetime = $appointment_date . ' ' . $appointment_time;

// Prepared statement to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO appointments (user_id, doctor, appointment_date, appointment_time, message) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("issss", $user_id, $doctor, $appointment_datetime, $appointment_time, $message); // Binding the parameters

// Execute the query
if ($stmt->execute()) {
echo "Appointment booked successfully!";
} else {
echo "Error: " . $stmt->error;
}

// Close the prepared statement
$stmt->close();
}
} else {
// Redirect to login page if the user is not logged in
header("Location: login.php");
exit();
}

// Close the database connection
mysqli_close($conn);
?>


