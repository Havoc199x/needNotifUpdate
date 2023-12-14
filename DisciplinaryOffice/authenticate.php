<?php
$servername = '127.0.0.1'; // servername
$username = 'Admin'; // username
$password = 'rootaccess'; // password
$dbname = 'loginpanel'; // database name

// Create connection
$connection = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve the entered username and password
$user_id = $_POST['user_id'];
$user_password = $_POST['password'];

// Perform the authentication against the user table
$userQuery = "SELECT * FROM user
INNER JOIN course ON user.user_id = course.user_id
WHERE user.user_id = '$user_id' AND password = '$user_password'";
$userResult = mysqli_query($connection, $userQuery);

if ($userResult) {
    $userRow = mysqli_fetch_assoc($userResult);
} else {
    echo "User query failed: " . mysqli_error($connection);
    // Handle the error accordingly, log, or display an error message
}


$doQuery = "SELECT * FROM user
WHERE user_id = '$user_id' AND password = '$user_password'";
$doResult = mysqli_query($connection, $doQuery);

if ($doResult) {
    $doRow = mysqli_fetch_assoc($doResult);
} else {
    echo "DO query failed: " . mysqli_error($connection);
    // Handle the error accordingly, log, or display an error message
}


// Check if the user exists and the credentials are correct
if ($userRow || $facultyRow||$doRow) {
    // Retrieve the user's name, role, and ID
    $user_name = $userRow['user_name'];
    $user_name2 = $facultyRow['user_name'];
    $user_name3 = $doRow['user_name'];
    $user_role = $userRow['role'];
    $user_role2 = $facultyRow['role'];
    $user_role3 = $doRow['role'];
    $course_name = $userRow['course_name'];
    $department_name = $facultyRow['department_name'];


    // Redirect based on user role
    if ($user_role == "Student") {
        // Store user information in session variables
    session_start();
    $_SESSION['user_name'] = $user_name;
    $_SESSION['course_name'] = $course_name;
    $_SESSION['user_id'] = $user_id;
        // Redirect to student dashboard
        header("Location: /DisciplinaryOffice/Userdashboard.php");
        exit();
    } else if ($user_role3 == "DO") {
        // Store user information in session variables
    session_start();
    $_SESSION['user_name'] = $user_name3;
    $_SESSION['user_id'] = $user_id;
        // Redirect to DO dashboard
        header("Location: /DisciplinaryOffice/DODashboard.php");
        exit();
    }else if ($user_role2 == "Faculty") {
        // Store user information in session variables
    session_start();
    $_SESSION['user_name2'] = $user_name2;
    $_SESSION['department_name'] = $department_name;
    $_SESSION['user_id'] = $user_id;
        // Redirect to DO dashboard
        header("Location: /DisciplinaryOffice/FacultyDashboard.php");
        exit();
    }
}

// Invalid credentials or user does not exist, redirect back to the login page with error message
header("Location: /DisciplinaryOffice/Login.php?error=InvalidUserOrPassword");
exit();
?>
