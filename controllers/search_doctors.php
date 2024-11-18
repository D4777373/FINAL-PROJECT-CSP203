<?php
<<<<<<< HEAD
// Include the database connection
include_once('../config/db.php');

// Initialize an empty response array
$response = ['status' => 'error', 'message' => 'No data received'];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        // Get the search term and specialty from the GET request
        $searchTerm = isset($_GET['searchTerm']) ? $_GET['searchTerm'] : '';
        $specialty = isset($_GET['specialty']) ? $_GET['specialty'] : '';

        // Build the SQL query with filters
        $query = "SELECT doctor_id, name, specialty, availability FROM doctors WHERE 1=1";
        $params = [];

        if (!empty($searchTerm)) {
            $query .= " AND name LIKE ?";
            $params[] = "%" . $searchTerm . "%";
        }

        if (!empty($specialty)) {
            $query .= " AND specialty = ?";
            $params[] = $specialty;
        }

        $stmt = $pdo->prepare($query);
        $stmt->execute($params);

        // Fetch the results
        $doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($doctors)) {
            $response = ['status' => 'success', 'data' => $doctors];
        } else {
            $response['message'] = 'No doctors found for the given criteria.';
        }
    } catch (Exception $e) {
        $response['message'] = 'An error occurred: ' . $e->getMessage();
    }
}

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
=======
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
>>>>>>> a5f77fe23b93adcb24dd118b56926564793db702
