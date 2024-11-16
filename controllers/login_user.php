 <?php
// Include the database connection
include_once('../config/db.php');

session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the SQL query to get the user
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // Check if user exists and the password matches
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username']; // Store username in session
        
        // Redirect to the dashboard or a page after login
        header("Location: ../dashboard.php");
        exit();  // Ensure no further code is executed after redirection
    } else {
        // If login fails, display error message
        $error_message = "Invalid credentials.";
    }
}
?>

<!-- The login form is included here -->
<form method="POST" action="">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Login</button>
</form>

