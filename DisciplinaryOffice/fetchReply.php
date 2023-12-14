<?php
//session
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

//Sanitize
$user_id = intval($_SESSION['user_id']);

// Fetch count of messages from report table
$sqlCount = "SELECT COUNT(*) as messageCount FROM schedule WHERE user_id = $user_id "; 
$resultCount = $conn->query($sqlCount);
$rowCount = $resultCount->fetch_assoc();

$messageCount = $rowCount['messageCount'];

// Fetch messages including sched_details, date sched
$sqlMessages = "SELECT sched_details,date_sched FROM schedule WHERE user_id = $user_id "; 
$resultMessages = $conn->query($sqlMessages);

$messages = array();
while ($row = $resultMessages->fetch_assoc()) {
    // Add fetched messages to the array along with sched details and date sched
    $messageData = array(
        'sched_details' => $row['sched_details'],
        'date_sched' => $row['date_sched'],
    );
    $messages[] = $messageData;
}

// Prepare data to be sent as JSON
$data = array(
    'messageCount' => $messageCount,
    'messages' => $messages
);

// Output data as JSON
header('Content-Type: application/json');
echo json_encode($data);

$conn->close();
?>
