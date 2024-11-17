<?php
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
