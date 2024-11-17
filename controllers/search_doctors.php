<?php
// db.php - Database connection
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['search_query'])) {
    // Sanitize the search query to prevent SQL injection
    $search_query = mysqli_real_escape_string($conn, $_GET['search_query']);
    
    // Query to search for doctors based on name or specialty
    $query = "SELECT * FROM doctors WHERE name LIKE '%$search_query%' OR specialty LIKE '%$search_query%'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Display the search results
        while ($doctor = mysqli_fetch_assoc($result)) {
            echo "<div>";
            echo "<h3>" . $doctor['name'] . "</h3>";
            echo "<p>Specialty: " . $doctor['specialty'] . "</p>";
            echo "<p>Location: " . $doctor['location'] . "</p>";
            echo "</div>";
        }
    } else {
        echo "No doctors found matching your search criteria.";
    }
}

mysqli_close($conn);
?>
