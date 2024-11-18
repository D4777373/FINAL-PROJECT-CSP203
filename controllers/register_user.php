<?php
// db.php - Database connection
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize the user input to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Hash the password for secure storage
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);
    
    // Check if the user already exists
    $check_query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($result) > 0) {
        echo "User already exists. Please use another email.";
    } else {
        // Insert the new user into the database
        $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password_hashed')";
        
        if (mysqli_query($conn, $query)) {
            echo "Registration successful!";
            // Redirect to login page
            header("Location: login.html");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
    mysqli_close($conn);
}
?>
