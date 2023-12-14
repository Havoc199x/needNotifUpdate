<?php
$servername = "127.0.0.1";
$username = "Admin";
$password = "rootaccess";
$dbname = "loginpanel";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $requestData = json_decode(file_get_contents('php://input'), true);

    if (isset($requestData['user_id'])) {
        $userId = $conn->real_escape_string($requestData['user_id']);

        // Debug: Check if $userId is received correctly
        error_log("User ID received: " . $userId);

        $updateQuery = "UPDATE status SET major_offense = 0, minor_offense = 0 WHERE user_id = '$userId'";
        
        // Debug: Check the generated SQL query
        error_log("SQL Query: " . $updateQuery);

        if ($conn->query($updateQuery) === TRUE) {
            http_response_code(200); // Success response
            exit; // Exit the script after successful update
        } else {
            // Debug: Print SQL error if the query fails
            error_log("Error updating record: " . $conn->error);
            http_response_code(500); // Server error response
            exit; // Exit the script if there's an error
        }
        
    } else {
        http_response_code(400); // Bad request response
        exit; // Exit the script for a bad request
    }
} else {
    http_response_code(405); // Method not allowed response
    exit; // Exit the script for an incorrect method
}
