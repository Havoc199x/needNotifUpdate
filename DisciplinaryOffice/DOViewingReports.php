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
    <title>Viewing Reports</title>
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
    
    .whats-new-container {
        margin-left: 300px;
        display: inline-block;
    }
    
    .title-container {
        border-start-start-radius: 60px;
        padding: 8px;
        background-color: gainsboro;
        width: 800px;
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
        border: none;
        cursor: pointer;
        background-color: #01579B;
        color: white;
    }
    
    .reply-button:hover {
        opacity: 0.9;
    }
    
    .reply-button:active {
        transform: translateY(1px);
    }
    
    .delete-button {
        color: black;
        border-radius: 20px;
        padding-top: 4px;
        padding-bottom: 4px;
        padding-left: 8px;
        padding-right: 8px;
        border: none;
        cursor: pointer;
        background-color: #01579B;
        color: white;
    }
    
    .delete-button:hover {
        opacity: 0.9;
    }
    
    .delete-button:active {
        transform: translateY(1px);
    }
    
    .action-container {
        text-align: center;
        word-spacing: 20px;
    }
    
    .date-now {
        text-align: right;
        margin-right: 20px;
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
    } 
</style>

<body>

    <div class="sidenav">
    <div class="notif-bell">
        <i style="font-size: 18px; color: yellow;" class="fa">&#xf0f3;</i>
        <span class="badge">0</span>
    </div>
    <hr>
        <div class="outside-container">
            <div class="profile-container">
                <img class="profile" src="/DisciplinaryOffice/logo/profile.png">
            </div>
            <div class="text-profile">
                <p>
                <span>Disciplinary Office</span><br>
                </p>
            </div>
        </div>
        <hr>

        <div id="clickMenuDashboard" class="dashboard-container"><a href="/DisciplinaryOffice/DODashboard.php"><i style="font-size:24px; color:white;" class="fa">&#xf0e4;</i>&nbsp;Dashboard</a></div>
        <div id="clickMenuSchedule" class="schedule-container"><a href="/DisciplinaryOffice/DOschedule.php"><i style="font-size:24px" class="fa">&#xf073;</i>&nbsp;Schedule</a></div>
        <div id="clickMenuViewReports" class="view-container"><a href="/DisciplinaryOffice/DOViewingReports.php"><i style="font-size:24px" class="fa">&#xf15b;</i>&nbsp;View Reports</a></div>
        <div id="clickMenuStudentRecords" class="student-records-conatiner"><a href="/DisciplinaryOffice/DOStudentRecords.php"><i style="font-size:24px" class="fa">&#xf039;</i>&nbsp;Student Records</a></div>
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
</body>

</html>