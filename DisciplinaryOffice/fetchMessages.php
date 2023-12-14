<?php
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

// Fetch count of messages from report table
$sqlCount = "SELECT COUNT(*) as messageCount FROM report"; 
$resultCount = $conn->query($sqlCount);
$rowCount = $resultCount->fetch_assoc();

$messageCount = $rowCount['messageCount'];

// Fetch messages including offense_type, violation_type, report_details, and file_type
$sqlMessages = "SELECT report_details, offense_type, violation_type, file_type FROM report"; 
$resultMessages = $conn->query($sqlMessages);

$messages = array();
while ($row = $resultMessages->fetch_assoc()) {
    // Add fetched messages to the array along with offense_type, violation_type, report_details, and file_type
    $messageData = array(
        'report_details' => $row['report_details'],
        'offense_type' => $row['offense_type'],
        'violation_type' => $row['violation_type'],
        'file_type' => $row['file_type']
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
