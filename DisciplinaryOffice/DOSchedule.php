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
    header("Location:/DisciplinaryOffice/Login.php");
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
    <title>Set | Schedule</title>
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
        background-color: black;
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
    
    @media screen and (max-height: 450px) {
        .sidenav {
            padding-top: 15px;
        }
        .sidenav a {
            font-size: 18px;
        }
    }
    
    .profile {
        background-color: whitesmoke;
        border-radius: 50%;
        width: 50px;
        margin-left: 18px;
    }
    
    .outside-container {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    .view-container:hover {
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
    
    .report-status-conatiner:hover {
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
    
    .main-container {
        margin-left: 100px; 
        display: inline-block
    }
    
    .title-container {
        border-radius: 30px;
        padding: 8px;
        background-color: gainsboro;
        width: 500px;
        display: block;
        margin-left: 300px;
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
    
    .reply-button {
        color: black;
        border-radius: 20px;
        padding-top: 4px;
        padding-bottom: 4px;
        padding-left: 8px;
        padding-right: 8px;
        border: solid;
        border-width: 1px;
        cursor: pointer;
    }
    
    .delete-button {
        color: black;
        border-radius: 20px;
        padding-top: 4px;
        padding-bottom: 4px;
        padding-left: 8px;
        padding-right: 8px;
        border: solid;
        border-width: 1px;
        cursor: pointer;
    }
    
    .action-container {
        text-align: center;
        word-spacing: 20px;
    }
    
    .date-now {
        text-align: right;
        margin-right: 20px;
    }
    
    .text-area-continer {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 50px;
    }
    
    .text-area::placeholder {
        padding-left: 8px;
    }
    
    .btn {
        display: inline-block;
        padding-top: 8px;
        padding-bottom: 8px;
        padding-left: 24px;
        padding-right: 24px;
        border-radius: 20px;
        border: none;
        cursor: pointer;
        background-color: #01579B;
        color: white;
    }
    
    .btn:hover {
        opacity: 0.9;
    }
    
    .btn:active {
        transform: translateY(1px);
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
        <div class="outside-container">
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
                <p style="color: white; opacity: 0.5;">STI Global City Taguig<br> Disciplinary Office</p>
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

    <div class="text-area-continer">
        <div>
        <h3>Set Schedule</h3>
        <form action="sendMessage.php" method="post">
        <textarea id="sched_details" name="sched_details" class="text-area" style="width: 100%; height: 150px; resize: none; text-align: left; text-indent: 5px; border-radius: 10px;" placeholder="Type Something..."></textarea>
        Choose Date <input type="date" id="date_sched" name="date_sched"><br><br>
        <br>
        <?php
        // Database connection setup
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

        // Fetch user_id values from the user table where role is 'student'
        $sql = "SELECT user_id FROM user WHERE role = 'student'"; // Update with your table name if different

        $result = $conn->query($sql);

        // Check if query execution was successful
        if ($result && $result->num_rows > 0) {
            echo '<select id="student_selected" name="student_selected" required>';
            echo '<option value="">Select Student</option>';

        // Loop through each row to create options
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['user_id'] . '">' . $row['user_id'] . '</option>';
            }

            echo '</select>';
        } else {
        echo '<p>No students found.</p>';
        }
        ?>
        <button class="btn" type="submit">Send</button>
        </form>

        </div>
    </div>

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