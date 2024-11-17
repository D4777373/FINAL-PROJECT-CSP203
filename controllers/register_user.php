<?php
// Include the database connection
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize user inputs
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Hash the password before saving
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    // Check if the user already exists
    $check_query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($result) > 0) {
        echo "User already exists. Please use a different email.";
    } else {
        // Insert new user into the database
        $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password_hashed')";
        
        if (mysqli_query($conn, $query)) {
            echo "Registration successful!";
            // Redirect to the login page
            header("Location: login.html");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
}
?>
