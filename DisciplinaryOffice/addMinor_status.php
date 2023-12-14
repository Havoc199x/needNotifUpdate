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

        // Increment minor offense
        $updateQuery = "UPDATE status SET minor_offense = minor_offense + 1 WHERE user_id = '$userId'";
        
        if ($conn->query($updateQuery) === TRUE) {
            // Check if minor offense reaches 3, reset to 0 and increment major offense
            $checkQuery = "SELECT minor_offense FROM status WHERE user_id = '$userId'";
            $result = $conn->query($checkQuery);
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $minorOffense = $row['minor_offense'];

                if ($minorOffense >= 3) {
                    // Reset minor offense to 0 and increment major offense
                    $resetQuery = "UPDATE status SET minor_offense = 0, major_offense = major_offense + 1 WHERE user_id = '$userId'";
                    if ($conn->query($resetQuery) === TRUE) {
                        http_response_code(200); // Success response
                        exit; // Exit the script after successful update
                    } else {
                        error_log("Error updating record: " . $conn->error);
                    }
                } else {
                    http_response_code(200); // Success response
                    exit; // Exit the script after successful update
                }
            } else {
                error_log("No rows found for user ID: " . $userId);
            }
        } else {
            error_log("Error updating record: " . $conn->error);
        }
        
        http_response_code(500); // Server error response
        exit; // Exit the script if there's an error
    } else {
        http_response_code(400); // Bad request response
        exit; // Exit the script for a bad request
    }
} else {
    http_response_code(405); // Method not allowed response
    exit; // Exit the script for an incorrect method
}

