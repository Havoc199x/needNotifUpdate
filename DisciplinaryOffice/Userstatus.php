<?php
session_start();

// Check if the session variables are set
if (isset($_SESSION['user_name'], $_SESSION['course_name'], $_SESSION['user_id'])) {
    // Retrieve the session variables
    $user_name = $_SESSION['user_name'];
    $course_name = $_SESSION['course_name'];
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
$conn = new mysqli('127.0.0.1','Admin','rootaccess','loginpanel');
// Fetching offense values for the logged-in user
$query = "SELECT major_offense, minor_offense FROM status WHERE user_id = $user_id";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $major_offense = $row['major_offense'];
    $minor_offense = $row['minor_offense'];
} else {
    $major_offense = 0;
    $minor_offense = 0;
}

$conn->close();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=3.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@100;200;300;400;500;600&display=swap" rel="stylesheet">
    <title>Reports | Status</title>
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
    
    .status-container:hover {
        background-color: black;
    }
    
    .make-report-container:hover {
        background-color: black;
    }
    
    .apply-file-container:hover {
        background-color: black;
    }
    
    .report-status-conatiner:hover {
        background-color: black;
    }
    
    .change-password-container {
        margin-top: 20px;
    }

    .change-password-container:hover {
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
        margin-top: 30px;
    }
    
    .logo-container {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    .STI-text {
        text-align: center;
    }


    .h5-box1 {
        display: inline-block;
        background-color:  gainsboro;
        padding-left: 40px;
        padding-right: 40px;
        padding-top: 30px;
        border-radius: 20px;
        color: black;
        text-align: center;

    }

    .h5-box2 {
        margin-left: 20px;
        display: inline-block;
        background-color:  gainsboro;
        padding-left: 40px;
        padding-right: 40px;
        padding-top: 30px;
        border-radius: 20px;
        color: black;
        text-align: center;

    }

    .h5-box3 {
        margin-left: 20px;
        display: inline-block;
        background-color:  gainsboro;
        padding-left: 40px;
        padding-right: 40px;
        padding-top: 30px;
        border-radius: 20px;
        color: black;
        text-align: center;
        

    }

    .container {
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        margin-top: 50px;
        grid-template-columns: none;
        grid-row: 40px;
        
    }

    .h2-container {
        text-align: center;
        margin-top: 70px;
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

    .container-messages {
        display: flex;
        justify-content: right;
        align-items: right;
        margin-right: 20px;
        cursor: pointer;

    }

    .container-messages:hover {
        opacity: 0.5;
    }

    .container-messages:active {
        transform: translateY(2px);
    } 

    .profile-container {
    position: relative;
    display: inline-block;
    margin-top: -45px;
    margin-right: 50px;
    }

    .profile-icon {
        position: absolute;
        top: 0;
        left: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 50px;
        height: 50px;
        background-color: whitesmoke;
        border-radius: 50%;
        cursor: pointer;
    }

    .profile-icon i {
        color: #888;
    }

    .profile-upload {
        display: none;
    }

    .details {
        text-align: left; 
        margin-left: 400px;
        background-color: gainsboro;
        padding: 14px;
        margin-top: 24px;
        width: 700px;
        border-radius: 20px;
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

.dropdown {
    display: none;
    position: absolute;
    background: white;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    z-index: 1000;
    cursor: pointer;
}

.dropdown.show {
    display: block;
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

    .text-profile {
        text-align: left;
        margin: 0;
        margin-right: 14px;
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
                    <span>Name: &nbsp; <?php echo $user_name; ?></span><br>
                    <span>Course: &nbsp; <?php echo $course_name; ?></span><br>
                    <span>Student ID: &nbsp; <?php echo $user_id; ?></span>
                </p>
            </div>
        </div>
        <hr>
        <div id="" class="status-container"><a href="/DisciplinaryOffice/Userdashboard.php"><i style="font-size:24px; color:white;" class="fa">&#xf0e4;</i>&nbsp;Dashboard</a></div>
        <div id="" class="status-container"><a href="/DisciplinaryOffice/Userstatus.php"><i style="font-size:24px" class="fa">&#xf2bb;</i>&nbsp;Status</a></div>
        <div id="" class="make-report-container"><a href="/DisciplinaryOffice/Userformreport.php"><i style="font-size:24px" class="fa">&#xf044;</i>&nbsp;Make Report</a></div>
        <div id="" class="report-status-conatiner"><a href="/DisciplinaryOffice/Userreportstatus.php"><i style="font-size:24px" class="fa">&#xf24a;</i>&nbsp;History Report</a></div>
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

<div class="h2-container">
    <h2>Offense and Violation</h2>
</div>

<script>
        document.addEventListener('DOMContentLoaded', function() {
        function updateNotification() {
            fetch('fetchReply.php')
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

                        // Create paragraph for schedule details and date
                        const messageParagraph = document.createElement('p');
                        messageParagraph.innerHTML = `Schedule Details: ${message.sched_details}<br>Date: ${message.date_sched}`;

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
                            // Your functionality for the "View" button goes here
                        });

                        // Append buttons to the buttons container
                        buttonsContainer.appendChild(viewButton);

                        // Append elements to the message container
                        messageDiv.appendChild(messageParagraph);
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


<div class="details">
<?php
    $total_offenses = $minor_offense + $major_offense;
    if ($total_offenses == 0) {
        echo '<h5>Currently: You have no Offense</h5>';
    } elseif ($total_offenses > 0 && $total_offenses < 3) {
        echo '<h5>Warning: You have existing violations. Please comply.</h5>';
    } else {
        echo '<h5>Warning: Please coordinate with the Disciplinary Office.</h5>';
    }
    ?>
</div>

<div class="container">
<?php
    
    $total_offenses = $minor_offense + $major_offense;

    if ($total_offenses == 0) {
        echo '<div class="h5-box1">
                <h5 style="margin: 0;">Status</h5> 
                <p><i style="font-size:24px; color: green;" class="fa">&#xf00c;</i></p>
              </div>';
        echo '<div class="h5-box2">
                <h5 style="margin: 0;">Minor Offense</h5>
                <p>0</p>
              </div>';
        echo '<div class="h5-box3">
                <h5 style="margin: 0;">Major Offense</h5>
                <p>0</p>
              </div>';

    } elseif ($total_offenses > 0 && $total_offenses < 3) {
        echo '<div class="h5-box1">
                <h5 style="margin: 0;">Status</h5> 
                <p><i style="font-size:24px; color: yellow;" class="fa">&#xf071;</i></p>
              </div>';
        echo '<div class="h5-box2">
                <h5 style="margin: 0;">Minor Offense</h5>
                <p>' . $minor_offense . '</p>
              </div>';
        echo '<div class="h5-box3">
                <h5 style="margin: 0;">Major Offense</h5>
                <p>' . $major_offense . '</p>
              </div>';

    } else {
        echo '<div class="h5-box1">
                <h5 style="margin: 0;">Status</h5> 
                <p><i style="font-size:24px; color: red;" class="fa">&#xf00d;</i></p>
              </div>';
        echo '<div class="h5-box2">
                <h5 style="margin: 0;">Minor Offense</h5>
                <p>' . $minor_offense . '</p>
              </div>';
        echo '<div class="h5-box3">
                <h5 style="margin: 0;">Major Offense</h5>
                <p>' . $major_offense . '</p>
              </div>';

    }
    ?>
</div>

<div class="details">
<div class="Clear-Minor-Major">
    <p>Following STI Global City Taguig's rules fosters a conducive learning atmosphere. 
        Adherence promotes discipline, mutual respect, and a culture of responsibility among students.
        Embracing these guidelines nurtures personal growth, ensuring a safe and thriving academic environment for all.</p>
</div>
</div>
</body>

</html>