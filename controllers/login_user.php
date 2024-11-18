<?php
// Include the database connection
include('db.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize user inputs
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query to find the user
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Start a session and store user data
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Redirect to the dashboard
            header("Location: dashboard.html");
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that email.";
    }

    mysqli_close($conn);
}
?>
