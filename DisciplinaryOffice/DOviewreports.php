<?php
session_start();

// Check if the session variables are set
if (isset($_SESSION['user_name'], $_SESSION['user_id'])) {
    // Retrieve the session variables
    $user_name = $_SESSION['user_name'];
    $user_id = $_SESSION['user_id'];

} else {
    // Session variables not set, handle the situation accordingly
    // For example, redirect back to the login page
    header("Location: /DisciplinaryOffice/Login.php");
    exit();
}
if (isset($_GET['logout'])) {
    // Destroy the session
    session_destroy();

    // Redirect back to the login page
    header("Location: /DisciplinaryOffice/Login.php");
    exit();
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@100;200;300;400;500;600&display=swap" rel="stylesheet">

    <title>Admin Dashboard</title>
</head>
<style>
    body {
        font-family: 'Noto Sans', sans-serif;
        font-weight: 400;
    }
    
    .sidenav {
        height: 100%;
        width: 320px;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background: #01579B;
        overflow-x: hidden;
        padding-top: 20px;
    }
    
    .sidenav a {
        padding: 6px 8px 8px 28px;
        text-decoration: none;
        font-size: 25px;
        color: white;
        display: block;
    }
    
    .logout {
        margin-top: 50px;
    }
    
    .change-password-conatiner {
        margin-top: 20px;
    }
    
    .logout:hover {
        opacity: 0.9;
    }
    
    .sidenav a:hover {
        opacity: 0.9;
    }
    
    .sidenav a:hover {
        color: #f1f1f1;
    }
    
    .main {
        margin-left: 160px;
        /* Same as the width of the sidenav */
        font-size: 28px;
        /* Increased text to enable scrolling */
        padding: 0px 10px;
    }
    
    /* Media query for smaller screens */
    @media screen and (max-width: 768px) {
    .sidenav {
        width: 100%; /* Change the width or behavior for smaller screens */
    }
    .report-container {
        margin-left: 0; /* Adjust margins for smaller screens */
    }
}
    
    .profile {
        background-color: whitesmoke;
        border-radius: 50%;
        width: 50px;
        margin-left: 18px;
    }
    
    .profile-outside-container {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    .view-container:hover {
        background-color: black;
    }
    
    .make-report-container:hover {
        background-color: black;
    }
    
    .apply-file-container:hover {
        background-color: black;
    }
    
    .files-status-container:hover {
        background-color: black;
    }
    
    .dashboard-container:hover {
        background-color: black;
    }
    
    .schedule-container:hover {
        background-color: black;
    }
    
    .student-records-conatiner:hover {
        background-color: black;
    }

    .logout:hover {
        background-color: black;
    }
    
    .text-profile {
        font-family: 'Noto Sans', sans-serif;
        font-size: 12px;
        margin-left: 18px;
        color: white;
    }
    
    .logo-size {
        width: 40px;
        margin-top: 70px;
    }
    
    .logo-container {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    .STI-text {
        text-align: center;
    }

    
    .whats-new-container {
        display: inline-block;
    }
    
    .title-container {
        border-radius: 20px;
        padding: 8px;
        background-color: gainsboro;
        width: 150px;
        display: block;
        text-align: center;
    }
    
    .DO-Profile {
        display: inline-block;
        margin-left: 18px;
    }
    
    .do-name-container {
        display: inline-block;
        margin-top: -20px;
        vertical-align: middle;
    }
    
    .view-full-details {
        color: #01579B;
    }
    
    .view-full-details-container {
        margin-left: 8px;
    }
    
    .date-now {
        text-align: right;
        margin-right: 20px;
    }
    
    .change-password-admin {
        font-size: 12px;
    }

    .all-link {
        color: black;
    }

    .privacy-link {
        display: inline-block;
        margin-left: -25px;
    }

    .report-link {
        display: inline-block;
        margin-left: -20px;
    }

    .terms-link {
        display: inline-block;
        margin-bottom: 28px;
        margin-left: -20px;
    }

    .address-school {
        color: white; 
        font-size: 12px;
    }

    .phone-number {
        color: white; 
        font-size: 12px;
    }

    .DO-dashboard-button {
        background-color: transparent !important;
        border: none;
        cursor: pointer;
    }

    .DO-dashboard-button:hover {
        opacity: 1;
        color: gray;
    }

    .DO-dashboard-button:active {
        transform: translateY(1px);
    }

    .notif-bell {
        position: relative;
        display: inline-block;
        margin-left: 10px;
        cursor: pointer;
    }

    .badge {
        position: absolute;
        top: -8px;
        right: -8px;
        background-color: red;
        color: white;
        border-radius: 50%;
        padding: 4px 8px;
        font-size: 8px;
        cursor: pointer;
    }

    /* Modal Styles */
    /* Styles for the pop-up modal */
    .notification-panel {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fefefe;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 600px;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
    }

    .message-container {
        text-align: center;
    }


    body {
    display: flex;
    justify-content: center;
    align-items: center;
    }

    .resume {
    width: 500px; /* Minimum width set to 500px */
    background-color: #fff;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .header {
    text-align: center;
    margin-bottom: 20px;
    }

    /* .header img {
    width: 150px;
    height: 150px;
    border-radius: 50%; /* Making the image a circle 
    object-fit: cover;
    border: 2px solid #ccc;
    }
    */

    .section {
    border-top: 1px solid #ccc;
    padding-top: 20px;
    }

    .section h2 {
    margin-top: 0;
    }

    .section p {
    margin-bottom: 5px;
    }

    .report-container {
    margin-left: 340px; /* Adjust as needed to create space for the side nav */
    padding: 20px; /* Add padding to separate the content */
    }

    .report {
        border: 1px solid #ccc; /* Optional: Add borders around each report */
        padding: 10px;
        margin-bottom: 10px; /* Optional: Add spacing between report sections */
    }

</style>

<body>


<!--- Side Bar Upper Part-->
<div class="sidenav">
<div class="notif-bell">
        <i style="font-size: 18px; color: yellow;" class="fa">&#xf0f3;</i>
        <span class="badge">0</span>
    </div>
    <div id="notifpanel" class="notification-panel">
        <div class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div class="modal-body">
                    <!-- Display messages here -->
                </div>
            </div>
        </div>
    </div>



    <hr>
        <div class="profile-outside-container">
            <div class="profile-container">
            </div>

            <div class="text-profile">
                <p>
                    Disciplinary Office
                </p>
            </div>
        </div>
        <hr>

        <div id="clickMenuDashboard" class="dashboard-container"><a href="/DisciplinaryOffice/DODashboard.php"><i style="font-size:24px; color:white;" class="fa">&#xf0e4;</i>&nbsp;Dashboard</a></div>
        <div id="clickMenuSchedule" class="schedule-container"><a href="/DisciplinaryOffice/DOschedule.php"><i style="font-size:24px" class="fa">&#xf073;</i>&nbsp;Schedule</a></div>
        <div id="clickMenuStudentRecords" class="student-records-conatiner"><a href="/DisciplinaryOffice/DOStudentRecords.php"><i style="font-size:24px" class="fa">&#xf039;</i>&nbsp;Student Records</a></div>
        <div id="clickMenuStudentRecords" class="student-records-conatiner"><a href="/DisciplinaryOffice/DOviewreports.php"><i style="font-size:24px" class="fa">&#xf2bc;</i>&nbsp;View Report</a></div>


        <div class="logout"><a href="?logout=true"><i style="font-size:24px" class="fa">&#xf011;</i>&nbsp;Log out</a></div>
        <div class="logo-container">
            <div><img class="logo-size" src="/DisciplinaryOffice/logo/STI_LOGO.ico"></div>
        </div>
        <div class="STI-text">
            <div>
                <p style="color: white; opacity: 0.5;">STI Global City Taguig<br></p>
                <div style="background-color: black; height: 200px;">
                        <div class="privacy-link"><a style="font-size: 11px; display: inline-block;" href="/DisciplinaryOffice/Privacy-Policy.php">Privacy Policy | </a></div>
                        <div class="report-link"><a style="font-size: 11px; display: inline-block;" href="/DisciplinaryOffice/Report-Abuse.php">Report Abuse |</a></div>
                        <div class="terms-link"><a style="font-size: 11px; display: inline-block;" href="/DisciplinaryOffice/Terms-of-Service.php">Terms of Service</a></div>
                        <div>
                        <address class="address-school">
                            STI Academic Center,<br> University Parkway Drive,<br>
                            Taguig, Metro Manila
                        </address>
                        <p class="phone-number">
                        &#x2706; Phone: (02) 8551 4984
                        </p>
                        <p>
                            
                        <a style="color: white; font-size: 11px;" 
                        href="https://www.facebook.com/globalcity.sti.edu/">Official Facebook Page</a>
                        </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--- View Reports--->
<?php
    //connection
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

// Fetch all reports from the database
$sql = "SELECT * FROM report";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    echo '<div class="report-container">';
    while ($row = $result->fetch_assoc()) {
        echo '<div class="report">';
        echo '<h2>Report ID: ' . $row['report_id'] . '</h2>';
        echo '<p>Offense Type: ' . $row['offense_type'] . '</p>';
        echo '<p>Violation Type: ' . $row['violation_type'] . '</p>';
        echo '<p>Report Details: ' . $row['report_details'] . '</p>';
        echo '<p>Report Date: ' . $row['report_date'] . '</p>';
        echo '<p>Reported Student Name: ' . $row['name'] . '</p>';


        // Display the image if file_type contains the file path
        if (!empty($row['file_type'])) {
            echo '<img src="' . $row['file_type'] . '" alt="Report Image" style="max-width: 300px; height: auto;">';
        }

        echo '</div>';
    }
    echo '</div>';
} else {
    echo "No reports found";
}
$conn->close();
?>
  <!--- End --->


 
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        function updateNotification() {
            fetch('fetchMessages.php')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Received data:', data); // Check if data is received properly

                    const badge = document.querySelector('.badge');
                    const messageContainer = document.querySelector('.modal-body');

                    badge.textContent = data.messageCount;

                    messageContainer.innerHTML = ''; // Clear previous messages

                    data.messages.forEach(message => {
                        // Create a container for each message
                        const messageDiv = document.createElement('div');
                        messageDiv.style.display = 'flex'; // Use flexbox for layout
                        messageDiv.style.flexDirection = 'column'; // Arrange items vertically

                        // Create paragraph for report_details, offense_type, and violation_type
                        const messageParagraph = document.createElement('p');
                        messageParagraph.innerHTML = `Report Details: ${message.report_details}<br>Offense Type: ${message.offense_type}<br>Violation Type: ${message.violation_type}`;

                        // Create image element for the file_type (assuming file_type holds the image URL)
                        const imageElement = document.createElement('img');

                        if (message.file_type && message.file_type.trim() !== '') {
                            // If a file is uploaded (file_type holds a non-empty URL), set the image source
                            imageElement.src = message.file_type; // Assuming file_type holds the image URL
                        } else {
                            // If no file is uploaded, set a placeholder or leave the src attribute empty
                            // Example: Set a placeholder image or leave src attribute empty
                            //imageElement.src = 'Empty Image';
                            // OR
                            // imageElement.src = '';
                        }

                        imageElement.style.maxWidth = '100px'; // Set max width for the image
                        imageElement.style.height = 'auto'; // Maintain aspect ratio
                        imageElement.style.marginBottom = '10px'; // Add margin for spacing

                        // Create a container for buttons
                        const buttonsContainer = document.createElement('div');
                        buttonsContainer.style.display = 'flex'; // Use flexbox for layout
                        buttonsContainer.style.justifyContent = 'space-between'; // Space buttons evenly

                        // Create a "View" button
                        const viewButton = document.createElement('button');
                        viewButton.textContent = 'View';
                        viewButton.className = 'view-btn';
                        viewButton.style.backgroundColor = '#01579B';
                        viewButton.style.color = 'white';
                        viewButton.style.borderRadius = '4px';
                        viewButton.style.border = 'none';
                        viewButton.style.padding = '5px 10px';
                        viewButton.style.cursor = 'pointer';

                        viewButton.addEventListener('click', function() {
                            console.log('View button clicked for message:', message);
                            window.location.href = 'http://localhost:8080/DisciplinaryOffice/DOviewreports.php';
                        });

                        // Create a "Reply" button
                        const replyButton = document.createElement('button');
                        replyButton.textContent = 'Reply';
                        replyButton.className = 'reply-btn';
                        replyButton.style.backgroundColor = '#4CAF50';
                        replyButton.style.color = 'white';
                        replyButton.style.borderRadius = '4px';
                        replyButton.style.border = 'none';
                        replyButton.style.padding = '5px 10px';
                        replyButton.style.cursor = 'pointer';

                        replyButton.addEventListener('click', function() {
                            console.log('Reply button clicked for message:', message);
                            window.location.href = 'http://localhost:8080/DisciplinaryOffice/DOschedule.php';
                        });

                        // Append buttons to the buttons container
                        buttonsContainer.appendChild(viewButton);
                        buttonsContainer.appendChild(replyButton);

                        // Append elements to the message container
                        messageDiv.appendChild(messageParagraph);

                        if (imageElement.src !== '') {
                            // Append image element only if src is not empty
                            messageDiv.appendChild(imageElement);
                        }

                        messageDiv.appendChild(buttonsContainer);

                        // Append the container to the message container
                        messageContainer.appendChild(messageDiv);
                    });
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }

        const notifBell = document.querySelector('.notif-bell');
        const notif = document.getElementById('notifpanel');
        const closeButton = document.querySelector('.close');
        notifBell.addEventListener('click', function() {
            const notificationPanel = document.querySelector('.notification-panel');
            if (notificationPanel.style.display === 'none') {
                notificationPanel.style.display = 'block';
                updateNotification();
            } else {
                notificationPanel.style.display = 'none';
            }
        });
        closeButton.addEventListener('click', function() {
            notif.style.display = 'none';
        });

        // Initially update notification when the page loads
        updateNotification();
    });




    </script>
</body>

</html>