<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disciplinary Office | STI Global City Taguig</title>
    <meta http-equiv="refresh" content="5;url=http://localhost:8080/DisciplinaryOffice/Userformreport.php">
</head>
<body>
    <div style="display: flex; flex: 1; justify-content: center; align-items:center;">
        <div style="height: 300px; width: 500px; text-align: center; color: black; border-radius: 20px;">
            <h1 style="font-family: 'Roboto', sans-serif;">Successfully submitted &#9989;</h1>
            <p style="font-family: 'Roboto', sans-serif;">You will be redirected to http://localhost/DisciplinaryOffice/Userformreport.php in 5 seconds...</p>
        </div>
    </div>

    </body>
</html>

<?php
session_start(); // Start the session

// Check if the user is logged in and retrieve their user ID from the session
if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    // Redirect the user to the login page or handle the case where the user is not logged in
    // Example:
    header("Location: login.php");
    exit(); // Ensure script stops here
}

// Establish connection to your database
$servername = "127.0.0.1";
$username = "Admin";
$password = "rootaccess";
$dbname = "loginpanel";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming you have already established the database connection

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user inputs
$name = $_POST['name'] ?? '';
$offense_type = $_POST['offense_type'] ?? '';
$violation_type = $_POST['violation_type'] ?? '';
$report_details = $_POST['report_details'] ?? '';

// Handle file upload
$upload_directory = 'uploads/'; // Directory where you want to store the uploaded files
$file_name = $_FILES['file_type']['name'];
$file_temp = $_FILES['file_type']['tmp_name'];
$file_type = pathinfo($file_name, PATHINFO_EXTENSION);

// Move the uploaded file to the specified directory
$destination = $upload_directory . $file_name;


if (move_uploaded_file($file_temp, $destination)) {
    // File moved successfully, store the file path in the database
    // Prepare and execute SQL query to insert data into the database
    $stmt = $conn->prepare("INSERT INTO report (user_id, name, offense_type, violation_type, file_type, report_details) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("isssss", $user_id, $name, $offense_type, $violation_type, $destination, $report_details);

        if ($stmt->execute()) {
            $report_id = $stmt->insert_id; // Retrieve the auto-generated report_id
            echo "Reported: " . $report_id;
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Error in preparing the SQL statement: " . $conn->error;
    }

    $stmt->close();
   
}




$conn->close();


?>

















