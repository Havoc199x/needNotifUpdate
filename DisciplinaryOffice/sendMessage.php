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

// Establish a connection to your MySQL database
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

// Capture form inputs
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = $_POST['sched_details'];
    $date = $_POST['date_sched'];
    $user_id = $_POST['student_selected']; // Get the user_id from the form or wherever it's coming from


    // Prepare SQL statement to insert data
    $sql = "INSERT INTO schedule (user_id, sched_details, date_sched) VALUES (?, ?, ?)";
    
    // Attempt to prepare the SQL statement
    $stmt = $conn->prepare($sql);

 // Check for SQL statement preparation error
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

// Bind parameters and execute the statement
$bindResult = $stmt->bind_param("iss", $user_id, $message, $date);

// Check for binding error
if ($bindResult === false) {
    die("Error binding parameters: " . $stmt->error);
}

// Execute the statement
$executeResult = $stmt->execute();

// Check if execution was successful
if ($executeResult === false) {
    echo "Error sending message: " . $stmt->error;
} else {
    echo "Message sent successfully!";
}
}
// Close the statement
$stmt->close();
?>



















